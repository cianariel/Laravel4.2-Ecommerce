<?php

namespace App\Helpers;

use \Illuminate\Routing\Route;
use  Illuminate\Routing\Router;;

class PageHelper {

    public static function getCanonicalLink($route, $key = false) {

        $base = 'https://ideaing.com';
        $routeName = $route->getName();
        $url = '';

        if($route->getName() == 'productDetails' && $key){
            $url = '/product/' . $key;
        }elseif($routeName == 'shopCategory' && is_array($key)) {
            $url = '/shop';
            foreach ($key as $k) {
                if($k){
                    $url .= '/' . $k;
                }
            }
        }

        if($url){
            $canonical = $base . $url;
            return $canonical;
        }else{
            return false;
        }



    }
}