<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use FeedParser;
use MetaTag;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use App\Models\Room;
use URL;
use Input;

class PageController extends ApiController
{

    public function __construct()
    {
        //check user authentication and get user basic information
        $this->authCheck = $this->RequestAuthentication(array('admin', 'editor', 'user'));

    }


    /**
     * Display the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }

        return view('home')->with('userData', $userData);
    }


    public function getContent($page = 1, $limit = 5, $tag = false, $type = false, $productCategory = false, $sortBy = false)
    {

        if ($tag && $tag !== 'undefined' && $tag != 'false' && $tag != '') {
            $tagID = Tag::where('tag_name', $tag)->lists('id')->toArray();
        } else {
            $tagID = false;
            $tag = false;
        }

        $offset = $limit * ($page - 1);

        if ($type == 'product' || !$stories = self::getStories($limit, $offset, $tag)) {
            $stories = [];
        }

        if ($productCategory) {
            $productCategory = ProductCategory::where('extra_info', $productCategory)->first();
        }

        if (@$productCategory) {
            $productCategoryID = $productCategory->id;
        } else {
            $productCategoryID = false;
        }

        if ($type == 'idea' || !$products = self::getProducts($limit, $page, $offset, $tagID, $productCategoryID, $sortBy)) {
            $products['result'] = [];
        }

        $return = array_merge($stories, $products['result']);

        usort($return, function ($a, $b) use ($sortBy) {
            if ($sortBy && @$b->$sortBy && @$a->$sortBy) {
                return @$a->$sortBy - @$b->$sortBy;
            } else {
                return strtotime(@$b->updated_at) - strtotime(@$a->updated_at);
            }
        });

        return $return;
    }

    public function getGridContent($page = 1, $limit = 5, $tag = false, $type = false, $grid = true)
    {

        if ($tag && $tag !== 'undefined' && $tag != 'false' && $tag != '') {
            $tagID = Tag::where('tag_name', $tag)->lists('id')->toArray();
        } else {
            $tagID = false;
            $tag = false;
        }

        if ($limit == 'undefined' || $limit == 0) {
            $productLimit = 6;
            $productOffset = 6 * ($page - 1);

            $storyLimit = 3;
            $storyOffset = 4 * ($page - 1);

        } else {
            $productLimit = $limit;
            $storyLimit = $limit;

            $productOffset = $limit * ($page - 1);
            $storyOffset = $limit * ($page - 1);
        }

        $featuredLimit = 3;
        $featuredOffset = $featuredLimit * ($page - 1);

        if ($type == 'product' || !$stories = self::getGridStories($storyLimit, $storyOffset, $featuredLimit, $featuredOffset, $tag)) {
            $stories = [
                'regular' => [],
                'featured' => [],
            ];
        }

        if ($type == 'idea' || !$products = self::getProducts($productLimit, $page, $productOffset, $tagID)) {
            $products['result'] = [];
        }

        if (!$stories['regular']) {
            $stories['regular'] = [];
        }

        $return['regular'] = array_merge($stories['regular'], $products['result']);
        $return['featured'] = $stories['featured'];

        usort($return['regular'], function ($a, $b) {
            return strtotime(@$b->updated_at) - strtotime(@$a->updated_at);
        });

        return $return;
    }


    public function getStories($limit, $offset, $tag)
    {
        $url = URL::to('/') . '/ideas/feeds/index.php?count=' . $limit . '&offset=' . $offset;
        if ($tag && $tag != 'false') {
            $url .= '&tag=' . $tag;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        $json = curl_exec($ch);

        $return = json_decode($json);

        return $return;
    }

    public function getGridStories($limit, $offset, $featuredLimit, $featuredOffset, $tag)
    {

        if (env('FEED_PROD') == true)
            $url = 'http://ideaing.com/ideas/feeds/index.php?count=' . $limit . '&no-featured&offset=' . $offset;
        else
            $url = URL::to('/') . '/ideas/feeds/index.php?count=' . $limit . '&no-featured&offset=' . $offset;

        if ($tag && $tag != 'false') {
            $url .= '&tag=' . $tag;
        }
//        print_r($url); die();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        $json = curl_exec($ch);

        $return['regular'] = json_decode($json);


        if (env('FEED_PROD') == true)
            $featuredUrl = 'http://ideaing.com/ideas/feeds/index.php?count=' . $featuredLimit . '&only-featured&offset=' . $featuredOffset . '&tag=' . $tag;
        else
            $featuredUrl = URL::to('/') . '/ideas/feeds/index.php?count=' . $featuredLimit . '&only-featured&offset=' . $featuredOffset . '&tag=' . $tag;


        if ($tag && $tag != 'false' && $tag != false) {
            $featuredUrl .= '&tag=' . $tag;
        }

//                print_r($featuredUrl); die();


        curl_setopt($ch, CURLOPT_URL, $featuredUrl);
        $json = curl_exec($ch);
        curl_close($ch);

        $return['featured'] = json_decode($json);

        return $return;
    }

    public function getRelatedStories($currentStoryID, $limit, $tags)
    {
        $url = URL::to('/') . '/ideas/feeds/index.php?count=' . $limit;

        if ($tags && $tags != 'false') {
            $url .= '&tag_in=' . implode(',', $tags);
        }
        if ($currentStoryID) {
            $url .= '&excludeid=' . $currentStoryID;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        $json = curl_exec($ch);

        $return = json_decode($json);

        return $return;
    }

    public function signupPage($email = '')
    {

        return view('signup')->with('email', $email)->with('tab', 'signup');
    }

    public function loginView()
    {
        return view('signup')->with('tab', 'login');
    }

    public function getProducts($limit, $page, $offset, $tagID, $productCategoryID = false, $sortBy = false)
    {
        $productSettings = [
            'ActiveItem' => true,
            'limit' => $limit,
            'page' => $page,
            'CustomSkip' => $offset,

            'CategoryId' => $productCategoryID,
            'sortBy' => $sortBy,
            'FilterType' => false,
            'FilterText' => false,
            'ShowFor' => false,
            'WithTags' => false,
        ];

        if (@$productCategoryID) {
            $productSettings['GetChildCategories'] = true;
        }

        if (is_array($tagID)) {
            $productSettings['TagId'] = $tagID;
        }

        $prod = new Product();

        $products = $prod->getProductList($productSettings);

        return $products;
    }

    public function getRelatedProducts($productID, $limit, $tagID)
    {
        $productSettings = [
            'ActiveItem' => true,
            'excludeID' => $productID,
            'limit' => $limit,
//            'page'       => $page,
//            'CustomSkip' => $offset,
//
//            'CategoryId' => false,
//            'FilterType' => false,
//            'FilterText' => false,
//            'ShowFor'    => false,
//            'WithTags'   => false,
        ];

        if (is_array($tagID)) {
            $productSettings['TagId'] = $tagID;
        }

        $prod = new Product();

        $products = $prod->getProductList($productSettings);

        return $products;
    }


    public function productDetailsPage($permalink)
    {
        $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }

        // return view('home')->with('userData',$userData);
        //  dd($this->getProducts(3,1,6));

        $product = new Product();
        $productData['product'] = $product->getViewForPublic($permalink);

        // Get category tree
        $catTree = $product->getCategoryHierarchy($productData['product']->product_category_id);

        $result = $product->productDetailsViewGenerate($productData, $catTree);

//        $currentTag = [];
        $currentTags = Product::find($productData['product']['id'])->tags()->lists('tag_id');

//        $tagNames = [];
        foreach ($currentTags as $tagID) {
            $tagNames[] = Tag::find($tagID)->tag_name;
        }

        $relatedIdeas = self::getRelatedStories($productData['product']['id'], 3, $tagNames);

//        $related

        MetaTag::set('title', $result['productInformation']['PageTitle']);
        MetaTag::set('description', $result['productInformation']['MetaDescription']);

        //   dd($result['selfImages']['picture'][0]['link']);
        return view('product.product-details')
            ->with('userData', $userData)
            ->with('permalink', $permalink)
            ->with('productInformation', $result['productInformation'])
            ->with('relatedProducts', $result['relatedProducts'])
            ->with('relatedIdeas', $relatedIdeas)
            ->with('selfImages', $result['selfImages'])
            ->with('storeInformation', $result['storeInformation']);
    }

    public function getRoomPage($permalink)
    {
        $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }

        // return view('home')->with('userData',$userData);
        $room = new Room();
        $roomData['room'] = $room->getViewForPublic($permalink);
        $result = $room->roomDetailsViewGenerate($roomData);
        MetaTag::set('title', $result['roomInformation']['MetaTitle']);
        MetaTag::set('description', $result['roomInformation']['MetaDescription']);
        //return $result;
        return view('room.landing')
            ->with('userData', $userData)
            ->with('roomInformation', $result['roomInformation']);
        // Get category tree
        /*$catTree = $product->getCategoryHierarchy($productData['product']->product_category_id);

        $result = $product->productDetailsViewGenerate($productData, $catTree);

        MetaTag::set('title',$result['productInformation']['PageTitle']);
        MetaTag::set('description',$result['productInformation']['MetaDescription']);

     //   dd($result['selfImages']['picture'][0]['link']);
        return view('product.product-details')
            ->with('permalink',$permalink)
            ->with('productInformation',$result['productInformation'])
            ->with('relatedProducts',$result['relatedProducts'])
            ->with('selfImages',$result['selfImages'])
            ->with('storeInformation',$result['storeInformation']);*/


    }

    public static function getShopMenu()
    {
        $return = Product::getForShopMenu();
        return $return;
    }


    public function getSocialCounts($url = ''){
        $input = Input::all();

        $url = 'http://' . $input['url'];

        if(!strpos($url, 'ideaing')){ // TODO - make more strict check on Production
            return 'Stop trying to hack my app, thanks';
        }

        $data['facebook']  = self::getFacebookLikes($url);
        $data['twitter']   = self::getTweets($url);
        $data['gplus']     = self::getPlusones($url);
        $data['pinterest'] = self::getPinterestShares($url);

        // TODO -- update counts, set to all boxes, set Twitter

        return $data;
    }


    private function getFacebookLikes($url) {
        $json_string = file_get_contents('http://graph.facebook.com/?id='.$url);
        $json = json_decode($json_string, true);
        if(isset($json['shares'])){
            return intval($json['shares']);
        } else {
            return 0;
        }
    }

    private function getTweets($url) {
//        $json_string = file_get_contents(' https://api.twitter.com/1.1/search/tweets.json?q=' . $url);
//        $json = json_decode($json_string, true);
//        if(isset($json['count'])){
//            return intval( $json['count'] );
//        } else {
            return 0;
//        }
    }

    private function getPlusones($url) {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, '{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        $curl_results = curl_exec ($curl);
        curl_close ($curl);

        $json = json_decode($curl_results, true);
        if(isset($json['result']['metadata']['globalCounts']['count'])){
            return intval( $json['result']['metadata']['globalCounts']['count'] );
        } else {
            return 0;
        }
    }


    function getPinterestShares($url) {
        $json_string = file_get_contents('http://api.pinterest.com/v1/urls/count.json?&url='.$url .'&format=json');
        $json_string = str_replace('receiveCount(', '', $json_string);
        $json_string = str_replace(')', '', $json_string);
        $json = json_decode( $json_string, true );
        if (isset($json)) {
            return intval($json['count']);
        } else {
            return 0;
        }
    }

//    function get_stumble($url) {
//        $json_string = file_get_contents('http://www.stumbleupon.com/services/1.01/badge.getinfo?url='.$url);
//        $json = json_decode($json_string, true);
//        if (isset($json['result']['views'])) {
//            return intval($json['result']['views']);
//        } else {return 0;}
//    }




}
