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
        $feed = new \FeedParser();

        //   function parseFeed($onlyData = false,$feedCount = 0) chk default value
        //   onlyData "true" returns raw post data and "false" returns blog name , title, link
        //   feedCount set the number of total required feed, 0 will pull all posts
        $data = $feed->parseFeed(true,4,true);

       // return $data;

        return view('feed.index')->with('jsonData',$data);// $data->parseFeed(true,2);
    }

}
