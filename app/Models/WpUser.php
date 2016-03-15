<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Product;
    use URL;
    use Redirect;

    class WpUser extends \Eloquent {

        protected $connection = 'wpdb';
        protected $table = 'users';
        public $timestamps = false;
//
//
//        public static function login($username, $password, $remember){
//
//            if($remember){
//                $remember = 1;
//            }else{
//                $remember = 0;
//            }
//            $url = 'http://ideaing.dev/ideas/api/?call=login&username=' . $username . '&password=' . $password . '&remember=' . $remember;
//
////            $response = file_get_contents($url);
//
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, $url);
//            curl_setopt($ch, CURLOPT_HEADER, 0);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_ENCODING, "");
//            $response = curl_exec($ch);
//
//            return json_decode($response);
//        }
//
//        public static function loginAndGoToWP($username, $password, $remember){
//
//            if($remember){
//                $remember = 1;
//            }else{
//                $remember = 0;
//            }
//            $url = 'http://ideaing.dev/ideas/api/?call=login&username=' . $username . '&password=' . $password . '&remember=' . $remember;
//
//            return Redirect::to($url);
//
////            $response = file_get_contents($url);
////
////            $ch = curl_init();
////            curl_setopt($ch, CURLOPT_URL, $url);
////            curl_setopt($ch, CURLOPT_HEADER, 0);
////            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
////            curl_setopt($ch, CURLOPT_ENCODING, "");
////            $response = curl_exec($ch);
////
////            return json_decode($response);
//        }
//
//        public static function logout(){
//
//            $response = file_get_contents(URL::to('/') . 'ideas/api/?call=logout');
//            return json_decode($response);
//
//        }
//
    }
