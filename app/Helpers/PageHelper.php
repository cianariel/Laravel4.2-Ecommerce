<?php

namespace App\Helpers;

use \Illuminate\Routing\Route;
use  Illuminate\Routing\Router;;
use App\Models\Giveaway;
use App\Models\ProductCategory;
use URL;

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
    public static function formatForMetaDesc($content) {

        $content = strip_tags($content);
        $excerpt = preg_replace('/(\.)\s+[^\.]*$/', '\1', substr($content, 0, 70));

        return $excerpt;

    }


    public static function getTopMenuItems() {
        $url = URL::to('/') . '/ideas/feeds/index.php?count=5 ';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        $json = curl_exec($ch);

        $return = json_decode($json);
//        $productCategories = ProductCategory::orderBy('created_at','asc')->take(2)->get();

//        $productCategories = [
//
//        ];

        if(!$return){
            $return = [];
        }

        return ($return);
    }

    public static function getCurrentGiveaway() {
        $giveaway = Giveaway::whereDate('ends', '>=', date('Y-m-d'))->whereDate('goes_live', '<=', date('Y-m-d'))->first();
        return $giveaway;
    }
}