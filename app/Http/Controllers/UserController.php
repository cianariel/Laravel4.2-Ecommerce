<?php

    namespace App\Http\Controllers;

    use App\Events\SendSubscriptionMail;
    use App\Models\Subscriber;
    use App\Models\User;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;


    use App\Events\SendActivationMail;
    use App\Events\SendResetEmail;
    use Crypt;
    use Illuminate\Http\Response as IlluminateResponse;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;

    use Carbon\Carbon;

    class UserController extends ApiController {

        public function __construct()
        {
            // Apply the jwt.auth middleware to all methods in this controller
            /* $this->middleware('jwt.auth',
                 ['except' => [
                     'emailSubscription','userProfile'
                 ]]);*/

            $this->subscriber = new Subscriber();
            $this->user = new User();
        }

        public function userList()
        {

            try{
                $userData = \Input::all();

                $settings['limit'] = $userData['limit'];
                $settings['page'] = $userData['page'];

                $userList = $this->user->getUserList($settings);

                return $this->setStatusCode(\Config::get("const.api-status.success"))
                ->makeResponse(array_merge($userList, $settings));
            } catch (Excpetion $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }

        }

        public function getUserById($id)
        {

            try{

                $user = $this->user->where('id','=',$id)->first();

                //$userList = $this->user->getUserList($settings);

                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($user);
            } catch (Excpetion $ex)
            {
                return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                    ->makeResponseWithError("System Failure !", $ex);
            }

        }


        public function securePageHeader()
        {
            $authCheck = $this->RequestAuthentication();

            if ($authCheck['method-status'] == 'success-with-http')
            {
                return view('user.secure-page-header');

            } elseif ($authCheck['method-status'] == 'success-with-ajax')
            {
                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($authCheck);

            } elseif ($authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            } elseif ($authCheck['method-status'] == 'fail-with-ajax')
            {

                return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                    ->makeResponseWithError($authCheck);
            }
        }


        public function authCheck()
        {
            if (true)
            {
                return \Redirect::to('/login');
            }
        }

        // Email subscription
        /**
         * @return mixed
         */
        public function emailSubscription()
        {

            $userData = \Input::all();
            $validationRules = [

                'rules'  => [
                    'Email' => isset($userData['Email']) ? 'required | email' : '',
                ],
                'values' => [
                    'Email' => isset($userData['Email']) ? $userData['Email'] : null,
                ]
            ];

            list($userData, $validator) = $this->inputValidation($userData, $validationRules);

            if ($validator->fails())
            {
                // return with the failed reason and field's information
                return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                    ->makeResponseWithError("Invalid Input Data :" . $validator->messages());
            }

            $subs = $this->subscriber->isASubscriber($userData['Email']);

            if ($subs != null)
            {
                return $this->setStatusCode(\Config::get("const.api-status.success-with-variation"))
                    ->makeResponse($subs);
            } else
            {
                $subs = $this->subscriber->subscribeUser($userData['Email']);
                \Event::fire(new SendSubscriptionMail(
                    $userData['Email']
                ));

                return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($subs);
            }

        }

        public function userProfile()
        {
            return view('user.user-profile');
        }


    }
