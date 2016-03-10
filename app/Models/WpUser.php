<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Product;

    class WpUser extends \Eloquent {

        protected $connection = 'wpdb';
        protected $table = 'users';


        public static function login($username, $password, $remember){

            if($remember){
                $remember = 1;
            }
            $response = file_get_contents(URL::to('/') . 'ideas/api/?call=login&username=' . $username . '&password=' . $password . '&remember=' . $remember);
            return json_decode($response);
        }

        public static function logout(){

            $response = file_get_contents(URL::to('/') . 'ideas/api/?call=logout');
            return json_decode($response);

        }

    }
