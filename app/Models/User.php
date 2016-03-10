<?php

namespace App\Models;

use Fenos\Notifynder\Builder\NotifynderBuilder;
use Fenos\Notifynder\Facades\Notifynder;
use Illuminate\Database\Eloquent\Model;
//use App\Models\UserProfile;
use App\Models\Media;
use App\Models\WpUser;
use App\Models\Notification;


use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Mockery\CountValidator\Exception;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Fenos\Notifynder\Notifable;

//use CustomAppException;


class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{

    use Notifable, Authenticatable, Authorizable, CanResetPassword,
        EntrustUserTrait {
        EntrustUserTrait::can insteadof Authorizable;
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];


    /**
     * Define Relationship
     * /
     *
     * /*
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userProfile()
    {
        return $this->hasOne('App\Models\UserProfile');
    }

    public function subscriber()
    {
        return $this->hasOne('App\Models\Subscriber');

    }

    public function medias()
    {
        return $this->morphMany('App\Models\Media', 'mediable');
    }

    /**
     * Defile custom model method
     */

    public function getUserList($settings)
    {
        $userModel = $this;

        $filterText = $settings['FilterValue'];

        if ($settings['FilterItem'] == 'user-name-filter') {
            $userModel = $userModel->where("name", "like", "%$filterText%");
        }
        if ($settings['FilterItem'] == 'user-email-filter') {
            $userModel = $userModel->where("email", "like", "%$filterText%");
        }


        $skip = $settings['limit'] * ($settings['page'] - 1);
        $userList['result'] = $userModel
            ->with('userProfile')
            ->with('medias')
            ->take($settings['limit'])
            ->offset($skip)
            ->orderBy('created_at', 'desc')
            ->get();

        $userList['count'] = $userModel->get()->count();
        return $userList;
    }


    /**
     * Save user information
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function SaveUserInformation($data)
    {
        try {
            \DB::transaction(function () use ($data) {
                $user = new User();

                $user->name = $data['FullName'];
                $user->email = $data['Email'];
                $user->password = \Hash::make($data['Password']);
                $user->save();

                $userProfile = new UserProfile();

                if (!empty($data['UserFrom']))
                    $userProfile->user_from = $data['UserFrom'];
                else
                    $userProfile->user_from = "Registration";

                $media = new Media();

                // $userProfile->full_name = $data['FullName'];
                // $userProfile->save();


                $media->media_name = $data['FullName'];
                $media->media_type = 'img-link';
                $media->media_link = (!empty($data['Picture'])) ? $data['Picture'] : \Config::get("const.user-image");

                // $result = $store->medias()->save($this->media);

                $user->userProfile()->save($userProfile);
                $user->medias()->save($media);

            });
        } catch (\Exception $ex) {
            \Log::error($ex);
            throw new \Exception($ex);
        }
        return true;
    }


    public function updateUserInformation($userData)
    {
        try {
            //$user = $this->IsEmailAvailable($userData['Email']);

        } catch (\Exception $ex) {

        }
    }


    public function IsEmailAvailable($email)
    {
        try {
            return User::with('userProfile')
                       ->with('medias')
                       ->where('email', $email)
                       ->firstOrFail();

        } catch (\Exception $ex) {
            return false;
        }
    }

    public function getUserById($id)
    {
        try {
            return User::with('userProfile')
                       ->with('medias')
                       ->where('id', $id)
                       ->firstOrFail();

        } catch (\Exception $ex) {
            return false;
        }
    }

    //todo need to implement permalink check feature
    public function checkUserByPermalink($permalink)
    {
        try {
            /*return User::with('userProfile')
                       ->with('medias')
                       ->where('email', $permalink)
                       ->firstOrFail();*/

        } catch (\Exception $ex) {
            return false;
        }
    }

    // assign role(s) to the user
    public function assignRole($email, $roles)
    {
        $user = $this->IsEmailAvailable($email);

        if ($user->roles()->count() > 0) {
            $user->detachRoles($user->roles);
        }

        foreach ($roles as $role) {
            $role = Role::where('name', '=', $role)->first();
            $user->attachRole($role);
        }
    }

    // get all assigned role of a user
    public function getUserRolesByEmail($email)
    {
        $user = $this->IsEmailAvailable($email);

        return $user->roles;
    }

    public function FindOrCreateUser($userData)
    {
        try {
            $user = $this->IsEmailAvailable($userData->email);

            if ($user == false) {

                $user['FullName'] = $userData->name;
                $user['Email'] = $userData->email;
                $user['Password'] = env('FB_DEFAULT_PASSWORD');

                // Remove FB's attached width parameter from the image link
                //$user['Picture'] = explode("?", $userData->avatar_original)[0];

                $user['Picture'] = $userData->avatar_original;

                $user['UserFrom'] = 'Facebook';

                $this->SaveUserInformation($user);

                $user = $this->IsEmailAvailable($userData->email);

                $user->status = 'Active';
                $user->save();


                // Assign role for the user
                $this->assignRole($userData->email, array('user'));

                $subscriber = new Subscriber();

                // subscribes a user if not already subscribed
                if ($subscriber->isASubscriber($userData->email) == false) {
                    $subscriber->email = $userData->email;
                    $subscriber->status = 'Subscribed';

                    $subscriber->save();
                }

                // set true if the user is a new user.
                $user['NewUser'] = true;

                return $user;

            } else {
                return $user;
            }
        } catch (\Exception $ex) {
            \Log::error($ex);
            throw new \Exception($ex);
        }

    }

    public function syncWpAdmin($userInfo = null)
    {
        $wpUser = new WpUser();

        return $wpUser->all();
        // User::setConnection('wpdb')where

    }

    public function IsAuthorizedUser($userData)
    {
        try {
            $user = User::where('email', $userData['Email'])->first();

            return \Hash::check($userData['Password'], $user->password) ? $user : false;

        } catch (\Exception $ex) {
            // throw new \Exception($ex);
            return false;
        }
    }

    // Broadcast notification for new event.
    public function sendNotificationToUsers($info)
    {
        $PostTime = $info['PostTime'];

        if (count($info['Users']) != 0) {
            Notifynder::loop($info['Users'], function (NotifynderBuilder $builder, $user) use ($info, $PostTime) {

                $builder->category($info['Category'])
                        ->from($info['SenderId'])
                        ->to($user)
                        ->url($info['Permalink'])
                        ->extra(compact('PostTime'));

            })->send();

        }
    }

    public function getNotificationForUser($userId)
    {
        $user = User::find($userId);


    }

    public function getNotification($userId)
    {
        $user = User::find($userId);

        $notification['NotReadNotice'] = $user->getNotificationsNotRead();
        $notification['NotReadNoticeCount'] = $user->countNotificationsNotRead();

        return $notification;
    }

    public function markNotificationAsRead($info)
    {
        $notice = Notification::where('to_id', $info['UserId'])
                              ->where('url', $info['Permalink'])
                              ->update(['read' => 1]);
    }


    public function userNotification($flag = false)
    {
        $user = User::find(41);

        // $flag = true;

        if ($flag) {
            Notifynder::category("user.following")
                      ->from(41)
                      ->to(41)
                      ->url('/notice/do/5')
                      ->send();
        } else {
            Notifynder::category("hello")
                      ->from(41)
                      ->to(41)
                      ->url('/cccc/do/5')
                      ->send();
        }


        // dd($user->getNotificationsNotRead());
        dd($user->getNotifications($limit = 3, $paginate = true));


        // dd($user->getNotificationsNotRead(),$user->readAllNotifications(),$user->getNotificationsNotRead());
        // dd();


        //  $user

        /*
$user->getNotifications($limit = null, $paginate = null, $order = 'desc');
$user->getNotificationsNotRead($limit = null, $paginate = null, $order = 'desc');
$user->getLastNotification();
$user->countNotificationsNotRead($category = null);
$user->readAllNotifications();
         * */

    }

    /* public function throwExc()
     {
         throw new CustomAppException("hi");
     }*/


}

