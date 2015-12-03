<?php

    namespace App\Http\Controllers;

    use Crypt;
    use Illuminate\Http\Request;
    use Laravel\Socialite\Contracts\Factory as Socialite;
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
            $this->middleware('jwt.auth', ['except' => ['secure','authenticate','fbLogin','registerUser']]);
        }


        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return "inside secure area";
        }

        public function securePage()
        {
            dd();

            return "inside secure area";
        }

        /**
         * @param Request $request
         * @return \Illuminate\Http\JsonResponse
         */
        public function authenticate(Request $request)
        {
            $credentials = $request->only('email', 'password');

            try
            {
                // verify the credentials and create a token for the user
                if (!$token = JWTAuth::attempt($credentials))
                {
                    return response()->json(['error' => 'invalid_credentials'], 401);
                }
            } catch (JWTException $e)
            {
                // something went wrong
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            // Check if the user is email verified or not
            try
            {
                $user = $this->user->IsEmailAvailable($credentials['email'])->first();//User::where('email', $credentials['email'])->first();
                if ($user->status != 'Active')
                {
                    return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)->makeResponseWithError('User status not active.');

                }
            } catch (\Exception $ex)
            {
                return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->makeResponseWithError('Internal Server Error!' . $ex);

            }

            // if no errors are encountered we can return a JWT
            return response()->json(compact('token'));
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

            $userInfo['token'] = $token;

            $userInfo['message'] = 'Successfully registered with Facebook';

            return $this->setStatusCode(IlluminateResponse::HTTP_OK)->makeResponse($userInfo);

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
                    return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)->makeResponseWithError("Invalid Input Data :" . $validator->messages());
                } elseif ($validator->passes())
                {
                    //$user = new User();

                    if ($this->user->IsEmailAvailable($userData['Email']) == false)
                    {
                        /*
                         * After successfully register the user data send JSON response if email is available.
                         * */
                        if ($this->user->SaveUserInformation($userData))
                            return $this->setStatusCode(IlluminateResponse::HTTP_OK)->makeResponse('Registration completed successfully,please verify email');
                    } else
                    {
                        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)->makeResponseWithError('User email exists');
                    }
                }
            } catch (\Exception $ex)
            {
                \Log::error($ex);

                return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->makeResponseWithError('Internal Server Error!', $ex);
            }

        }

        public function activeUser()
        {

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


    }
