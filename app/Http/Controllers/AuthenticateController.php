<?php

    namespace App\Http\Controllers;

    use App\Events\SendActivationMail;
    use Crypt;
    use Illuminate\Http\Request;
    //use Laravel\Socialite\Contracts\Factory as Socialite;
    use App\Http\Requests;
    use Illuminate\Http\Response as IlluminateResponse;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use App\Models\User;

    class AuthenticateController extends ApiController {

        public function __construct()
        {
            $this->user = new User();

            // Apply the jwt.auth middleware to all methods in this controller
            $this->middleware('jwt.auth', ['except' => ['verifyEmail', 'index', 'authenticate', 'fbLogin', 'registerUser']]);
        }


        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            \Log::error('inside index');
            return "inside non secure area";
        }

        public function securePage()
        {
            //dd();

            return "inside secure area";
        }

        /**
         * @param Request $request
         * @return \Illuminate\Http\JsonResponse
         */
        public function authenticate(Request $request)
        {
            $credentials = $request->only('Email', 'Password');

            try
            {

                $authUser = $this->isValidUser($credentials);
                if($authUser == false)
                {
                    return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)
                        ->makeResponseWithError('Invalid credentials.');
                }else{
                    $token = JWTAuth::fromUser($authUser);
                }


            } catch (JWTException $ex)
            {
                // something went wrong
                \Log::error($ex);

                return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
                    ->makeResponseWithError('Token creation failed !');

                // return response()->json(['error' => 'could_not_create_token'], 500);
            }

            // Check if the user is email verified or not
            try
            {
                $user = $this->user->IsEmailAvailable($credentials['Email'])->first();
                if ($user->status != 'Active')
                {
                    return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)
                        ->makeResponseWithError('User status not active.');

                }
            } catch (\Exception $ex)
            {
                return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
                    ->makeResponseWithError('Internal Server Error!' . $ex);

            }


            // if no errors are encountered we can return a JWT
            return $this->setStatusCode(IlluminateResponse::HTTP_OK)
                ->setAuthToken($token)
                ->makeResponse("Successfully authenticated.");

        }

        public function fbLogin(Request $request)
        {

            $hasCode = $request->has('code');

            // check if the user is authenticated or not.
            if (!$hasCode)
                return \Socialite::driver('facebook')->redirect();
            else
                $fbUser = \Socialite::driver('facebook')->user();

            /*
            If a user is authenticated then check whether the user is
            registered in our system or not.
            */
            $userInfo = $this->user->FindOrCreateUser($fbUser);


            /*
            Set authentication code and pass JSON data in API response.
            */
            $token = JWTAuth::fromUser($userInfo);

            /* $userInfo['token'] = $token;

             $userInfo['message'] = 'Successfully registered with Facebook';*/

            return $this->setStatusCode(IlluminateResponse::HTTP_OK)
                ->setAuthToken($token)
                ->makeResponse("Successfully registered with Facebook");

        }


        public function registerUser()
        {
            try
            {
                /*
                Validate user input first before processing data.
                */
                list($userData, $validator) = $this->inputValidation();

                if ($validator->fails())
                {
                    // return with the failed reason and field's information
                    return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                        ->makeResponseWithError("Invalid Input Data :" . $validator->messages());
                } elseif ($validator->passes())
                {

                    if ($this->user->IsEmailAvailable($userData['Email']) == false)
                    {
                        /*
                         * After successfully register the user data send JSON response if email is available.
                         * */
                        if ($this->user->SaveUserInformation($userData))

                            // On successful user registration an email will be send through Event to verify email id.
                            \Event::fire(new SendActivationMail(
                                $userData['FullName'],
                                $userData['Email'],
                                Crypt::encrypt($userData['Email'])
                            ));

                        return $this->setStatusCode(IlluminateResponse::HTTP_OK)
                            ->makeResponse('Registration completed successfully,please verify email');
                    } else
                    {
                        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                            ->makeResponseWithError('User email exists');
                    }
                }
            } catch (\Exception $ex)
            {
                \Log::error($ex);

                return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
                    ->makeResponseWithError('Internal Server Error!', $ex);
            }

        }


        /**
         * Verify a user from the email
         * @param $code
         * @return string
         */
        public function verifyEmail($code)
        {
            try
            {
                $email = \Crypt::decrypt(trim($code));

                $user = $this->user->IsEmailAvailable($email);

                if ($user != null)
                {
                    $user->status = "Active";
                    $user->save();
                    $message = "Thanks " . $user->name . " for verify your email";

                } else
                {
                    $message = "verification Failed";
                }
            } catch (\Exception $ex)
            {
                \Log::error($ex);
                $message = "Verification Failed !!";
            }

            return $message;

        }

        public function sendPasswordResetEmail(Request $request)
        {
            $userData['Email'] = $request->get('Email');

            $validationRules = [

                'rules'  => [
                    'Email'    => 'required | email'
                ],
                'values' => [
                    'Email'    => isset($userData['Email']) ? $userData['Email'] : null
                ]
            ];

            $validator = \Validator::make($validationRules['values'], $validationRules['rules']);


            if ($validator->fails())
            {
                // return with the failed reason and field's information
                return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                    ->makeResponseWithError("Invalid Email :" . $validator->messages());
            } elseif ($validator->passes())
            {


            }

        }

        /**
         * User input validation
         * @return array
         */
        private function inputValidation()
        {
            // Trim blank spaces from

            \Input::merge(array_map('trim', \Input::all()));

            $userData = \Input::all();

            $validationRules = [

                'rules'  => [
                    'FullName' => 'required | max: 25',
                    'Email'    => 'required | email',
                    'Password' => 'required | min: 6 '
                ],
                'values' => [
                    'FullName' => isset($userData['FullName']) ? $userData['FullName'] : null,
                    'Email'    => isset($userData['Email']) ? $userData['Email'] : null,
                    'Password' => isset($userData['Password']) ? $userData['Password'] : null
                ]
            ];

            $validator = \Validator::make($validationRules['values'], $validationRules['rules']);

            return array($userData, $validator);
        }

        private function isValidUser($userData)
        {
            $email = isset($userData['Email']) ? $userData['Email'] : null;
            $password = isset($userData['Password']) ? $userData['Password'] : null;

            if (is_null($email) or is_null($password))
            {
                return false;
            } else
            {
                return $this->user->IsAuthorizedUser($userData);
            }


        }


    }
