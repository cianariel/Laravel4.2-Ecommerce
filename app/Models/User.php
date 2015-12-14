<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    //use App\Models\UserProfile;


    use Illuminate\Auth\Authenticatable;
    use Illuminate\Auth\Passwords\CanResetPassword;
    use Illuminate\Foundation\Auth\Access\Authorizable;
    use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
    use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
    use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
    use Mockery\CountValidator\Exception;

    use CustomAppException;


    class User extends Model implements AuthenticatableContract,
        AuthorizableContract,
        CanResetPasswordContract {

        use Authenticatable, Authorizable, CanResetPassword;

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
        protected $fillable = ['name', 'email', 'password'];

        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = ['id', 'password', 'remember_token', 'created_at', 'updated_at'];


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


        /**
         * Defile custom model method
         * @param $data
         * @return bool
         * @throws \Exception
         */
        public function SaveUserInformation($data)
        {
            try
            {

                \DB::transaction(function () use ($data)
                {
                    $user = new User();

                    $user->name = $data['FullName'];
                    $user->email = $data['Email'];
                    $user->password = \Hash::make($data['Password']);
                    $user->save();

                    $userProfile = new UserProfile();
                    // $userProfile->full_name = $data['FullName'];
                    $userProfile->save();

                    $user->userProfile()->save($userProfile);

                });
            } catch (\Exception $ex)
            {
                \Log::error($ex);
                throw new \Exception($ex);
            }

            return true;

        }


        public function IsEmailAvailable($email)
        {
            try
            {
                return User::with('UserProfile')
                    ->where('email', $email)
                    ->firstOrFail();

            } catch (\Exception $ex)
            {
                return false;
            }

        }

        public function FindOrCreateUser($userData)
        {
            try
            {
                $user = $this->IsEmailAvailable($userData->email);

                if ($user == false)
                {
                    $user['FullName'] = $userData->name;
                    $user['Email'] = $userData->email;
                    $user['Password'] = env('FB_DEFULT_PASSWORD');

                    $this->SaveUserInformation($user);

                    $user = $this->IsEmailAvailable($userData->email);

                    $user->status = 'Active';
                    $user->save();

                    return $user;

                } else
                {
                    return $user;
                }
            } catch (\Exception $ex)
            {
                \Log::error($ex);
                throw new \Exception($ex);
            }

        }

        public function IsAuthorizedUser($userData)
        {
            try
            {
                $user = User::where('email', $userData['Email'])->first();

                return \Hash::check($userData['Password'], $user->password) ? $user : false;

            } catch (\Exception $ex)
            {
                throw new \Exception($ex);
            }
        }

        public function throwExc()
        {
            throw new CustomAppException("hi");
        }


    }

