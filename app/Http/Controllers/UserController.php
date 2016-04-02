<?php

namespace App\Http\Controllers;

use App\Events\SendSubscriptionMail;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\Role;
use App\Models\Media;

use App\Http\Requests;

use Illuminate\Http\Response as IlluminateResponse;
use JWTAuth;

use Carbon\Carbon;

class UserController extends ApiController
{

    public function __construct()
    {

        $this->subscriber = new Subscriber();
        $this->user = new User();
        $this->roleModel = new Role();
        $this->media = new Media();

        //check user authentication and get user basic information
        $this->authCheck = $this->RequestAuthentication(array('admin', 'editor', 'user'));

    }

    public function userList()
    {

        try {
            $userData = \Input::all();

            $settings['limit'] = $userData['limit'];
            $settings['page'] = $userData['page'];
            $settings['FilterItem'] = isset($userData['FilterItem']) ? $userData['FilterItem'] : '';
            $settings['FilterValue'] = isset($userData['FilterValue']) ? $userData['FilterValue'] : '';
            //    $settings['']

            $userList = $this->user->getUserList($settings);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                        ->makeResponse(array_merge($userList, $settings));
        } catch (Excpetion $ex) {
            return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                        ->makeResponseWithError("System Failure !", $ex);
        }

    }

    // used in Admin. Get user information by id with user role
    public function getUserById($id)
    {

        try {

            $totalRoleCollection = $this->roleModel->get(array('id', 'name', 'display_name'));

            $user = $this->user->where('id', '=', $id)->first();

            $userRoles = $this->user->getUserRolesByEmail($user->email);

            $roleCollection = array();

            foreach ($userRoles as $role) {
                array_push($roleCollection, $role['name']);
            }

            $user['Roles'] = $roleCollection;
            $user['RoleCollection'] = $totalRoleCollection;

            //$userList = $this->user->getUserList($settings);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                        ->makeResponse($user);
        } catch (Excpetion $ex) {
            return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                        ->makeResponseWithError("System Failure !", $ex);
        }

    }

    public function getWpUsers()
    {
        $data = $this->user->syncWpAdmin();
        dd($data);
    }

    // send user info and admin role status
    public function getUserByEmail()
    {
        $email = base64_decode(\Input::get('_wptk'));

        $userInfo['user-data'] = $this->user->IsEmailAvailable($email);
        $userInfo['user-data']['login'] = true;
        $isAdmin = $userInfo['user-data']->hasRole('admin');
        $userInfo['user-data'] = $userInfo['user-data']->toArray();

        $result = base64_encode(serialize(['data' => $userInfo, 'IsAdmin' => $isAdmin]));

        // Decode process from WP end , check returning $decode
        // $result = unserialize(base64_decode($result));
        return $result;
    }

    public function getUserByEmailRaw($email)
    {
        $data = $this->user->IsEmailAvailable($email);
        return $data == false ? "false" : $data;

        // return serialize(['data' => $data]);
    }

    // Email subscription
    /**
     * @return mixed
     */
    public function emailSubscription()
    {

        $userData = \Input::all();
        $validationRules = [

            'rules' => [
                'Email' => isset($userData['Email']) ? 'required | email' : '',
            ],
            'values' => [
                'Email' => isset($userData['Email']) ? $userData['Email'] : null,
            ]
        ];

        list($userData, $validator) = $this->inputValidation($userData, $validationRules);

        if ($validator->fails()) {
            // return with the failed reason and field's information
            return $this->setStatusCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
                        ->makeResponseWithError("Invalid Input Data :" . $validator->messages());
        }

        $subs = $this->subscriber->isASubscriber($userData['Email']);

        if ($subs != null) {
            return $this->setStatusCode(\Config::get("const.api-status.success-with-variation"))
                        ->makeResponse($subs);
        } else {
            $subs = $this->subscriber->subscribeUser($userData['Email']);
            \Event::fire(new SendSubscriptionMail(
                $userData['Email']
            ));

            // set cookie to hide popup
            $this->setCookie('hide-signup', 'true', 9999999);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                        ->makeResponse($subs);
        }

    }

    public function userProfile($permalink = "")
    {
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];

            // 'profilePicture'   => $this->authCheck['profile-picture'],
            $data = array(
                'userData' => $userData,
                'profile' => ($userData->medias[0]->media_link == '') ? \Config::get("const.user-image") : $userData->medias[0]->media_link,
                'fullname' => $userData->name,
                'address' => $userData->userProfile->address,
                'personalInfo' => $userData->userProfile->personal_info,
                //   'login'     => true,
                //   'permalink' => $userData->userProfile->permalink
                'permalink' => $permalink,
                'isAdmin' => $userData->hasRole('admin') || $userData->hasRole('editor')

            );

            return view('user.user-profile', $data);


        } elseif ($this->authCheck['method-status'] == 'fail-with-http') {
            return \Redirect::to('login');
        }


    }

    public function hideSignup()
    {
        $this->setCookie('hide-signup', 'true', 1440);
        return \Redirect::back();

    }

    //todo need to implement permalink check feature

    public function checkUserPermalink($permalink)
    {


    }

    // Fetch notification for current user
    public function notification($uid)
    {
//            $this->user->userNotification();
        $data = $this->user->getNotificationForUser($uid);

        return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($data);

    }

    // Mark all notice as read
    public function notificationReadAll($uid)
    {
        $result = $this->user->notificationMarkReadAll($uid);

        return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($result);

    }


}
