<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Models\UserProfile;
use App\Models\Media;
use App\Models\WpUser;


use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Mockery\CountValidator\Exception;
use Zizaco\Entrust\Traits\EntrustUserTrait;

use CustomAppException;
use Illuminate\Contracts\Hashing\Hasher;



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
//                $user->password = \Hash::make($data['Password']);
                $user->password = hash('md5',$data['Password']);

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

    // Sync system user with blog (wordpress) user
    public function syncWpAdmin($id = 65, $makeUserActive = true)
    {
        $systemUser = $this->getUserById($id);

        $name = explode(" ", $systemUser['name']);
        $firstName = $name[0];
        $lastName = $name[1];

        $wpUser = new WpUser();

        $wpUserInfo = $wpUser->where('user_email', $systemUser['email'])->get();

        if (empty($wpUserInfo->count())) {
            $wpUser->user_login = $systemUser['email'];
            $wpUser->user_pass = $makeUserActive == true ? $systemUser['password'] : 'NO ACCESS';
            $wpUser->user_nicename = $firstName;//$systemUser->personal_info->;
            $wpUser->user_registered = $systemUser['created_at'];
            $wpUser->user_status = 0;//$systemUser['email'];
            $wpUser->display_name = $systemUser['name'];
            $wpUser->user_email = $systemUser['email'];

            $wpUser->save();

            // set wp-meta table info

            $data = [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'id' => $wpUser->id
            ];

            $this->wpUserMetaAdd($data);

            // update the main user table info

            $this->updateUserStatusForWpUser($makeUserActive, $systemUser);
        } else {

            // $datas =  WpUser::where('user_login', $wpUserInfo[0]['user_login'])
            //     ->all();

            WpUser::where('user_login', $wpUserInfo[0]['user_login'])
                  ->update([
                      'user_login' => $systemUser['email'],
                      'user_pass' => $makeUserActive == true ? $systemUser['password'] : 'NO ACCESS',
                      'user_nicename' => $firstName,//$systemUser->personal_info->;
                      'user_registered' => $systemUser['created_at'],
                      'user_status' => 0,//$systemUser['email'];
                      'display_name' => $systemUser['name'],
                      'user_email' => $systemUser['email']
                  ]);

            $data = [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'id' => $wpUserInfo[0]['ID']
            ];

            // delete the previos meta info and insert with the new info
            $wpUserMeta = \DB::connection('wpdb');//->table('usermeta');
            $wpUserMeta->delete('delete from wp_usermeta where user_id=' . $wpUserInfo[0]['ID']);

            $this->wpUserMetaAdd($data);

            // update the main user table info
            $this->updateUserStatusForWpUser($makeUserActive, $systemUser);


        }
    }

    /**
     * @param $data
     */
    private function wpUserMetaAdd($data)
    {
        $metaHead = [
            'nickname', 'first_name', 'last_name', 'description', 'rich_editing', 'comment_shortcuts', 'admin_color', 'use_ssl', 'show_admin_bar_front',
            'wp_capabilities', 'wp_user_level', 'wp_user_avatar', 'dismissed_wp_pointers', 'default_password_nag', 'session_tokens', 'wp_dashboard_quick_press_last_post_id'
        ];
        $metaInfo = [
            $data['firstName'], $data['firstName'], $data['lastName'], '', 'true', 'false', 'fresh', 0, 'true', 'a:1:{s:6:"editor";b:1;}', '7',
            '', '', '', 'a:1:{s:64:"165c21c817a63200b4e63661dcd00ca58ec0b5a5af81cd84f4f61657dcceb10f";a:4:{s:10:"expiration";i:1456954939;s:2:"ip";s:14:"67.164.191.103";s:2:"ua";s:121:"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Safari/537.36";s:5:"login";i:1456782139;}}',
            '2147'
        ];

        $wpUserMeta = \DB::connection('wpdb');//->table('usermeta');

        for ($i = 0; $i < count($metaHead); $i++) {
            $wpUserMeta->insert("insert into wp_usermeta (user_id,meta_key,meta_value) values (?,?,?)", array($data['id'], $metaHead[$i], $metaInfo[$i]));
        }
    }

    /**
     * @param $makeUserActive
     * @param $systemUser
     */
    private function updateUserStatusForWpUser($makeUserActive, $systemUser)
    {
        $systemUser = User::find($systemUser['id']);
        $systemUser->is_blog_user = $makeUserActive == true ? 'true' : '';
        $systemUser->save();
    }

    public function IsAuthorizedUser($userData)
    {
        try {
            $user = User::where('email', $userData['Email'])->first();

          //  return \Hash::check($userData['Password'], $user->password) ? $user : false;

            $password = hash('md5',$userData['Password']);

            return ($password == $user->password) ? $user : false;

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
