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
        $feed = new \FeedParser();

        //   function parseFeed($onlyData = false,$feedCount = 0) chk default value
        //   onlyData "true" returns raw post data and "false" returns blog name , title, link
        //   feedCount set the number of total required feed, 0 will pull all posts
        $stories = $feed->parseFeed(true,4,true);

        // TODO - time posted should be '1 hours ago' etc
        // TODO - we need to control the number of posts fetched

        // TODO - in the future we need to intermix stories and products in one array, so they are output randomly on the page

       // return $data;

        return view('home')->with('stories', $stories);// $data->parseFeed(true,2);
    }

}
