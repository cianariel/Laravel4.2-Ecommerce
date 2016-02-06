<?php

    namespace App\Http\Controllers;

    use App\Events\SendSubscriptionMail;
    use App\Models\Subscriber;


    use App\Http\Requests;
    use App\Http\Controllers\Controller;


    use App\Events\SendActivationMail;
    use App\Events\SendResetEmail;
    use Crypt;
    use Illuminate\Http\Response as IlluminateResponse;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use App\Models\User;
    use Carbon\Carbon;

    class UserController extends ApiController {

        public function __construct()
        {
            // Apply the jwt.auth middleware to all methods in this controller
            $this->middleware('jwt.auth',
                ['except' => [
                    'emailSubscription','userProfile'
                ]]);
            $this->subscriber = new Subscriber();

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
                $this->subscriber->email = $userData['Email'];
                $this->subscriber->status = 'Subscribed';

                $subs = $this->subscriber->save();
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
