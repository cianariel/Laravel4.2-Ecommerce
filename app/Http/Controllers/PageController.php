<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use FeedParser;

class PageController extends Controller
{
    /**
     * Display the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        //URL of targeted site
        $url = "http://staging.ideaing.com/blog/feeds/index.php?count=8&category-id=1";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        $json = curl_exec($ch);
        $stories = json_decode($json);

        curl_close($ch);

//        print_r($stories); die();
        // return $data;
        return view('home')->with('stories', $stories);// $data->parseFeed(true,2);
    }

}
