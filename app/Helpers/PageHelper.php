<?php

namespace App\Helpers;

use \Illuminate\Routing\Route;
use  Illuminate\Routing\Router;;

class PageHelper {

    public static function getCanonicalLink($route, $key = false) {

        $base = 'https://ideaing.com/';

        if($route->getName() == 'productDetails' && $key){
            $url = 'product/' . $key;
        }

        if($url){
            $canonical = $base . $url;
            return $canonical;
        }else{
            return false;
        }



    }
}