<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Models\UserProfile;
use App\Models\Media;


use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Mockery\CountValidator\Exception;
use Zizaco\Entrust\Traits\EntrustUserTrait;

use CustomAppException;


class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{

    use Authenticatable, Authorizable, CanResetPassword,
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
                $media = new Media();

                // $userProfile->full_name = $data['FullName'];
                // $userProfile->save();


                $media->media_name = $data['FullName'];
                $media->media_type = 'img-upload';
                $media->media_link = \Config::get("const.user-image");

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

                    $this->subscriber->save();
                }

                return $user;

            } else {
                return $user;
            }
        } catch (\Exception $ex) {
            \Log::error($ex);
            throw new \Exception($ex);
        }

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

    public function throwExc()
    {
        throw new CustomAppException("hi");
    }


}

