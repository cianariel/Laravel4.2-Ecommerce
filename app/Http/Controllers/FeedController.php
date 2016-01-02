<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use FeedParser;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $feed = new \FeedParser();
//
//        //   function parseFeed($onlyData = false,$feedCount = 0, $cacheable = false) chk default value
//        //   onlyData "true" returns raw post data and "false" returns blog name , title, link
//        //   feedCount set the number of total required feed, 0 will pull all posts
//        //   Third parameter will set the caching enable by setting true or cache will remain disable,
//        $data = $feed->parseFeed(true,1,true);

        //URL of targeted site
        $url = "http://http://staging.ideaing.com/blog/feeds/index.php?count=2&category-id=1";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        $data = curl_exec($ch);


        curl_close($ch);

        // return $data;
         print_r($data);

        return view('feed.index')->with('jsonData',$data);// $data->parseFeed(true,2);
    }

}
