<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
//use FeedParser;
use MetaTag;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Tag;
use App\Models\Room;
use App\Models\Giveaway;
use App\Models\HomeHero;
use URL;
use Input;
use App\Models\Sharing;
use Sitemap;
use PageHelper;
use Route;
use DB;
use Redis;


class PageController extends ApiController
{

    public function __construct()
    {
        //check user authentication and get user basic information

        $this->authCheck = $this->RequestAuthentication(array('admin', 'editor', 'user'));

        $this->clearTemporarySessionData();
    }


    public function searchPage()
    {
        $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }

        MetaTag::set('title', 'Search Results | Ideaing');

        return view('search.index')->with('userData', $userData);
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
        $homehero = new HomeHero();
        $result = $homehero->heroDetailsViewGenerate();

        $sliderContent = self::getHeroSliderContent();
//        $sliderContent = (array)$sliderContent;

        MetaTag::set('title', 'Ideaing | Ideas for Smarter Living');
        MetaTag::set('description', 'Ideaing inspires you to live a smarter and beautiful home. Get ideas on using home automation devices including WiFi cameras, WiFi doorbells, door locks, security, energy, water and many more.');
        //return $result;
        return view('home')
            ->with('userData', $userData)
            ->with('sliderContent', $sliderContent)
            ->with('homehero', $result);
    }


    public static function getHeroSliderContent()
    {
        $cacheKey = "slider-ideas";

        if ($cachedContent = PageHelper::getFromRedis($cacheKey, true)) {
            $return = $cachedContent;
        } else {
            $url = URL::to('/') . '/ideas/feeds/index.php?count=4&only-slider';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_ENCODING, "");
            $json = curl_exec($ch);

            $return = json_decode($json, true);

            $cached = PageHelper::putIntoRedis($cacheKey, $return, '24 hours');
        }

        return $return;

    }


    public function getContent($page = 1, $limit = 5, $tag = false, $type = false, $productCategory = false, $sortBy = false)
    {

        $cacheKey = "plain-content-$page-$limit-$tag-$type-$productCategory-$sortBy";

        if ($cachedContent = PageHelper::getFromRedis($cacheKey)) {
            $return = $cachedContent;
            $return->fromCache = true;
            $return->cacheKey = $cacheKey;
            return json_encode($return);
        }

        if ($tag && $tag !== 'undefined' && $tag != 'false' && $tag != '') {
            $tagID = Tag::where('tag_name', $tag)->lists('id')->toArray();
        } else {
            $tagID = false;
            $tag = false;
        }

        $offset = $limit * ($page - 1);
        $leftOver = 0;

        if ($type == 'product' || !$stories = self::getStories($limit + 1, $offset, $tag)) {
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

        if ($type == 'idea' || !$products = self::getProducts($limit + 1, $page, $offset, $tagID, $productCategoryID, $sortBy)) {
            $products['result'] = [];
        }

        // we try to pull one extra item in each category, to know if there is more content availiable (in that case, we later display a 'Load More' button
        $stories = array_slice($stories, 0, $limit);
        if (!empty(array_slice($stories, $limit, 1))) {
            $leftOver++;
        }

        $prods = array_slice($products['result'], 0, $limit);
        if (!empty(array_slice($products['result'], $limit, 1))) {
            $leftOver++;
        }

        $return['content'] = array_merge($stories, $prods);

        $return['content'] = array_values(array_sort($return['content'], function ($value) {
            $value = (object)$value;
            return strtotime($value->raw_creation_date);

        }));

        $return['content'] = array_reverse($return['content']);


        if ($leftOver > 0) {
            $return['hasMore'] = true;
        } else {
            $return['hasMore'] = false;
        }

        $cached = PageHelper::putIntoRedis($cacheKey, $return, '1 hour');

        $return['wasCached'] = $cached;
        $return['fromCache'] = false;

        return $return;
    }

    public function getTimelineContent($daysback = 1, $tag = false, $type = false, $ideaCategory = false)
    {

        $cacheKey = "timeline-content-$daysback-$tag-$type-$ideaCategory";

//        if($cachedContent = PageHelper::getFromRedis($cacheKey)){
//            $return = $cachedContent;
//            $return->fromCache = true;
//            $return->cacheKey = $cacheKey;
//            return json_encode($return);
//        }

        if ($tag && $tag !== 'undefined' && $tag != 'false' && $tag != '') {
            $tagID = Tag::where('tag_name', $tag)->lists('id')->toArray();
        } else {
            $tagID = false;
            $tag = false;
        }


        $timeStamp = date('Y-m-d', strtotime('-'.$daysback.' days'));
        $date = date_create($timeStamp);


        $productSettings = [
            'ActiveItem' => true,
            'limit' => 3,
            'page' => 1,
            'Date' => date_format($date, 'Y-m-d'),
//            'CustomSkip' => $offset,
//            'CategoryId' => $productCategoryID,
//            'sortBy' => $sortBy,
            'FilterType' => false,
            'FilterText' => false,
            'ShowFor' => false,
            'WithTags' => false,
            'WithAverageScore' => true,
        ];

//        if (@$productCategoryID) {
//            $productSettings['GetChildCategories'] = true;
//        }

        if (is_array($tagID)) {
            $productSettings['TagId'] = $tagID;
        }

        $prod = new Product();

        $products = $prod->getProductList($productSettings);

        if ($type == 'idea' || !$products) {
            $products['result'] = [];
        }


        $url = URL::to('/') . '/ideas/feeds/index.php?count=3&no-featured';

        if ($tag && $tag != 'false') {
            $url .= '&tag=' . $tag;
        }

        $dateQuery = '&year='.date_format($date, 'Y').'&monthnum='.date_format($date, 'm').'&day='.date_format($date, 'd') ;

        $url .= $dateQuery;

//        if ($category && $category != 'false') {
//            $url .= '&category-name=' . $category;
//        }
//
//        if ($limit == 10 && $category != 'deals') { // CMS homepage, needs to have no deals
//            $url .= '&no-deals';
//        }

//        print_r($url); die();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        $json = curl_exec($ch);

        $ideaCollection = json_decode($json);

        $newIdeaCollection = new Collection();
        $comment = new App\Models\Comment();

        if ($ideaCollection) {
            foreach ($ideaCollection as $singleIdea) {
                $tempIdea = collect($singleIdea);
                $countValue = $comment->ideasCommentCounter($singleIdea->id);
                $tempIdea->put('CommentCount', $countValue);
                $newIdeaCollection->push($tempIdea);
            }
        }

        // type casting to object
        $regularStories = json_decode($newIdeaCollection->toJson(), FALSE);

        $featuredUrl = URL::to('/') . '/ideas/feeds/index.php?count=1&only-featured&no-deals';
//
//
        if ($tag && $tag != 'false' && $tag != false) {
            $featuredUrl .= '&tag=' . $tag;
        }
//
//        if ($category && $category != 'false') {
//            $featuredUrl .= '&category-name=' . $category;
//        }
//
        curl_setopt($ch, CURLOPT_URL, $featuredUrl);
        $json = curl_exec($ch);
        curl_close($ch);

        $return['featured'] = json_decode($json);
        $ideaCollection = json_decode($json);

        $newIdeaCollection = new Collection();
        $comment = new App\Models\Comment();

        if ($ideaCollection) {
            foreach ($ideaCollection as $singleIdea) {
                $tempIdea = collect($singleIdea);
                $countValue = $comment->ideasCommentCounter($singleIdea->id);
                $tempIdea->put('CommentCount', $countValue);
                $newIdeaCollection->push($tempIdea);
            }
        }

        $featuredStories = $newIdeaCollection;

//        return $return;




        // we try to pull one extra item in each category, to know if there is more content availiable (in that case, we later display a 'Load More' button
//        $regularStories = array_slice($stories['regular'], 0, $storyLimit);
//
//        if (!empty(array_slice($stories['regular'], $storyLimit, 1))) {
//            $leftOver++;
//        }
//
//
//        if ($stories['featured']) {
//            $featuredStories = array_slice($stories['featured']->toArray(), 0, $featuredLimit);
//            if (!empty(array_slice($stories['featured']->toArray(), $featuredLimit, 1))) {
//                $leftOver++;
//            }
//        } else {
//            $featuredStories = [];
//        }
//
//        $prods = array_slice($products['result'], 0, $productLimit);
//
//        if (!empty(array_slice($products['result'], $productLimit, 1))) {
//            $leftOver++;
//        }
//
        $return['content']['regular'] = array_merge($regularStories, $products['result']);
        $return['content']['featured'] = $featuredStories;

        usort($return['content']['regular'], function ($a, $b) {
            return strtotime(@$b->raw_creation_date) - strtotime(@$a->raw_creation_date);
        });

//        if ($leftOver > 0) {
//            $return['hasMore'] = true;
//        } else {
//            $return['hasMore'] = false;
//        }
//
//        $cached = PageHelper::putIntoRedis($cacheKey, $return, '1 hour');
//
//        $return['wasCached'] = $cached;
//        $return['fromCache'] = false;
        return $return;
    }

    public function getGridContent($page = 1, $limit = 5, $tag = false, $type = false, $ideaCategory = false, $daysback = false)
    {
        $cacheKey = "grid-content-$page-$limit-$tag-$type-$ideaCategory";

//          if($cachedContent = PageHelper::getFromRedis($cacheKey)){
//            $return = $cachedContent;
//            $return->fromCache = true;
//            $return->cacheKey = $cacheKey;
//            return json_encode($return);
//       	  }

        if ($tag && $tag !== 'undefined' && $tag != 'false' && $tag != '') {
            $tagID = Tag::where('tag_name', $tag)->lists('id')->toArray();
        } else {
            $tagID = false;
            $tag = false;
        }

        if ($limit == 'undefined' || $limit == 0) {
            $productLimit = 6;
            $productOffset = 6 * ($page - 1);

            $storyLimit = 4;
            $storyOffset = 5 * ($page - 1);

        } else {
            $productLimit = $limit;
            $storyLimit = $limit;

            $productOffset = $limit * ($page - 1);
            $storyOffset = $limit * ($page - 1);
        }

        $featuredLimit = 3;
        $featuredOffset = $featuredLimit * ($page - 1);
        $leftOver = 0;

        if ($type == 'product' || !$stories = self::getGridStories($storyLimit + 1, $storyOffset, $featuredLimit + 1, $featuredOffset, $tag, $ideaCategory, $daysback)) {
            $stories = [
                'regular' => [],
                'featured' => [],
            ];
        }
        if ($type == 'idea' || !$products = self::getProducts($productLimit + 1, $page, $productOffset, $tagID, $daysback)) {
            $products['result'] = [];
        }

        if (!$stories['regular']) {
            $stories['regular'] = [];
        }

        // we try to pull one extra item in each category, to know if there is more content availiable (in that case, we later display a 'Load More' button
        $regularStories = array_slice($stories['regular'], 0, $storyLimit);

        if (!empty(array_slice($stories['regular'], $storyLimit, 1))) {
            $leftOver++;
        }

        if($stories['featured']) {
            $featuredStories = array_slice($stories['featured']->toArray(), 0, $featuredLimit);
            if (!empty(array_slice($stories['featured']->toArray(), $featuredLimit, 1))) {
                $leftOver++;
            }
        } else {
            $featuredStories = [];
        }

        $prods = array_slice($products['result'], 0, $productLimit);

        if (!empty(array_slice($products['result'], $productLimit, 1))) {
            $leftOver++;
        }

        $return['content']['regular'] = array_merge($regularStories, $prods);
        $return['content']['featured'] = $featuredStories;

        usort($return['content']['regular'], function ($a, $b) {
            return strtotime(@$b->raw_creation_date) - strtotime(@$a->raw_creation_date);
        });

        if ($leftOver > 0) {
            $return['hasMore'] = true;
        } else {
            $return['hasMore'] = false;
        }

        $cached = PageHelper::putIntoRedis($cacheKey, $return, '1 hour');

        $return['wasCached'] = $cached;
        $return['fromCache'] = false;
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
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        $json = curl_exec($ch);

        //  echo $json;
        //  die();

        //  $return = json_decode($json);

        $ideaCollection = json_decode($json);

        $newIdeaCollection = new Collection();
        $comment = new App\Models\Comment();

        if ($ideaCollection) {

            foreach ($ideaCollection as $singleIdea) {

                if ($tag == 'deal') {
                    $singleIdea->dealPage = true;
                }

                $tempIdea = collect($singleIdea);

                $countValue = $comment->ideasCommentCounter($singleIdea->id);

                $tempIdea->put('CommentCount', $countValue);

                $newIdeaCollection->push($tempIdea);

            }
        }


        return $newIdeaCollection->toArray();//$return;
    }


    public function getGridStories($limit, $offset, $featuredLimit, $featuredOffset, $tag = false, $category = false, $daysback = false)
    {

        $url = URL::to('/') . '/ideas/feeds/index.php?count=' . $limit . '&no-featured&offset=' . $offset;

        if ($tag && $tag != 'false') {
            $url .= '&tag=' . $tag;
        }

        if ($category && $category != 'false') {
            $url .= '&category-name=' . $category;
        }

        if ($limit == 10 && $category != 'deals') { // CMS homepage, needs to have no deals
            $url .= '&no-deals';
        }

        if($daysback){
            $timeStamp = date('Y-m-d', strtotime('-'.$daysback.' days'));
            $date = date_create($timeStamp);
            $dateQuery = '&year='.date_format($date, 'Y').'&monthnum='.date_format($date, 'm').'&day='.date_format($date, 'd') ;
            $url .= $dateQuery;
        }

        //print_r($url); die();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        $json = curl_exec($ch);

        $ideaCollection = json_decode($json);

        $newIdeaCollection = new Collection();
        $comment = new App\Models\Comment();

        if ($ideaCollection) {

            foreach ($ideaCollection as $singleIdea) {

                $tempIdea = collect($singleIdea);

                $countValue = $comment->ideasCommentCounter($singleIdea->id);

                $tempIdea->put('CommentCount', $countValue);

                $newIdeaCollection->push($tempIdea);

            }
        }

        // type casting to object

        $return['regular'] = json_decode($newIdeaCollection->toJson(), FALSE);


        $featuredUrl = URL::to('/') . '/ideas/feeds/index.php?count=' . $featuredLimit . '&only-featured&offset=' . $featuredOffset . '&no-deals';

        if($daysback){
            $featuredUrl .= $dateQuery;
        }

        if ($tag && $tag != 'false' && $tag != false) {
            $featuredUrl .= '&tag=' . $tag;
        }

        if ($category && $category != 'false') {
            $featuredUrl .= '&category-name=' . $category;
        }

        curl_setopt($ch, CURLOPT_URL, $featuredUrl);
        $json = curl_exec($ch);
        curl_close($ch);

        // $return['featured'] = json_decode($json);

        $ideaCollection = json_decode($json);

        $newIdeaCollection = new Collection();
        $comment = new App\Models\Comment();

        if ($ideaCollection) {

            foreach ($ideaCollection as $singleIdea) {

                $tempIdea = collect($singleIdea);

                $countValue = $comment->ideasCommentCounter($singleIdea->id);

                $tempIdea->put('CommentCount', $countValue);

                $newIdeaCollection->push($tempIdea);

            }
        }

        $return['featured'] = $newIdeaCollection;

        return $return;
    }

    public function getRelatedStories($currentStoryID, $limit, $tags)
    {
        $tagString = implode('-', $tags);
        $cacheKey = "related-products-$currentStoryID-$limit-$tagString";

        if ($cachedContent = PageHelper::getFromRedis($cacheKey)) {
            return $cachedContent;
        } else {
            $url = URL::to('/') . '/ideas/feeds/index.php?count=' . $limit . '&no-deals';

            if ($tags && $tags != 'false') {
                $url .= '&tag_in=' . strtolower(implode(',', $tags));
            }
            if ($currentStoryID) {
                $url .= '&excludeid=' . $currentStoryID;
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_ENCODING, "");
            $json = curl_exec($ch);

            $return = json_decode($json);
            PageHelper::putIntoRedis($cacheKey, $return);
            return $return;
        }
    }

    public function signupPage($email = '')
    {
        MetaTag::set('title', 'Sign Up | Ideaing');

        return view('user.signup')->with('email', $email)->with('tab', 'signup');
    }

    public function loginView()
    {
        MetaTag::set('title', 'Log In | Ideaing');

        return view('user.signup')->with('tab', 'login');
    }

    public function getProducts($limit, $page, $offset, $tagID, $productCategoryID = false, $sortBy = false, $daysback = false)
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
            'WithAverageScore' => true,
        ];

        if($daysback){
            $timeStamp = date('Y-m-d', strtotime('-'.$daysback.' days'));
            $date = date_create($timeStamp);
            $productSettings['Date'] = date_format($date, 'Y-m-d');
        }

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
        $cacheKey = "related-products-$productID-$limit-$tagID";
        if ($cachedContent = PageHelper::getFromRedis($cacheKey)) {
            return $cachedContent;
        } else {
            $productSettings = [
                'ActiveItem' => true,
                'excludeID' => $productID,
                'limit' => $limit,
            ];

            if (is_array($tagID)) {
                $productSettings['TagId'] = $tagID;
            }

            $prod = new Product();

            $products = $prod->getProductList($productSettings);
            PageHelper::putIntoRedis($cacheKey, $products);

            return $products;
        }
    }


    public function productDetailsPage($permalink)
    {
        $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }

        $cacheKey = "product-details-$permalink";
        if ($cachedContent = PageHelper::getFromRedis($cacheKey, true)) {
//            $cachedContent->fromCache = true;
            $result = $cachedContent;

            // TODO -- get rid of loops

            if ($result['productInformation']['Review']) {
                foreach ($result['productInformation']['Review'] as $i => $review) {
                    $result['productInformation']['Review'][$i] = (object)$review;
                }
            }

            if ($result['productInformation']['Specifications']) {
                foreach ($result['productInformation']['Specifications'] as $i => $spec) {
                    $result['productInformation']['Specifications'][$i] = (object)$spec;
                }
            }

            if ($result['relatedIdeas']) {
                foreach ($result['relatedIdeas'] as $i => $idea) {
                    $result['relatedIdeas'][$i] = (object)$idea;
                }
            }

        } else {

            $product = new Product();
            $productData['product'] = $product->getViewForPublic($permalink);

            // Get category tree
            $catTree = $product->getCategoryHierarchy($productData['product']->product_category_id);

            $result = $product->productDetailsViewGenerate($productData, $catTree);

            $currentTags = Product::find($productData['product']['id'])->tags()->lists('tag_id');
            foreach ($currentTags as $tagID) {
                $tagNames[] = str_replace(' ', '-', Tag::find($tagID)->tag_name);
            }

            $tagNames = empty($tagNames) ? "" : $tagNames;

            if ($tagNames != "")
                $relatedIdeas = self::getRelatedStories($productData['product']['id'], 3, $tagNames);
            else
                $relatedIdeas = "";

            $result['relatedIdeas'] = $relatedIdeas;
            $result['canonicURL'] = PageHelper::getCanonicalLink(Route::getCurrentRoute(), $permalink);
            PageHelper::putIntoRedis($cacheKey, $result, '+3 months');
        }


        MetaTag::set('title', $result['productInformation']['PageTitle']);
        MetaTag::set('description', $result['productInformation']['MetaDescription']);


        if ($userData['method-status'] == 'fail-with-http') {
            $isAdmin = false;
            $userData['id'] = 0;
        } else {
            $isAdmin = $userData->hasRole('admin');
        }

        // override the Amazon review if it's zero
        $amazonReview = empty($result['productInformation']['Review'][1]->value)?$result['productInformation']['Review'][0]->value:$result['productInformation']['Review'][1]->value;

        $reviewScore = intval(((($result['productInformation']['Review'][0]->value > 0 ? $result['productInformation']['Review'][0]->value : $amazonReview) + $amazonReview)/2)*20);

      //  dd($result['selfImages']);
        return view('product.product-details')
            ->with('isAdminForEdit', $isAdmin)
            ->with('productId', $result['productInformation']['Id'])
            ->with('userData', $userData)
            ->with('permalink', $permalink)
            ->with('productInformation', $result['productInformation'])
            ->with('reviewScore', $reviewScore)
            ->with('relatedProducts', $result['relatedProducts'])
            ->with('relatedIdeas', $result['relatedIdeas'])
            ->with('selfImages', $result['selfImages'])
            ->with('storeInformation', $result['storeInformation'])
            ->with('canonicURL', $result['canonicURL'])
            ->with('MetaDescription', $result['productInformation']['MetaDescription']);
    }

    public function getRoomPage($permalink)
    {
        $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }
        $room = new Room();
        $roomData['room'] = $room->getViewForPublic($permalink);
        $result = $room->roomDetailsViewGenerate($roomData);
        MetaTag::set('title', $result['roomInformation']['MetaTitle']);
        MetaTag::set('description', $result['roomInformation']['MetaDescription']);
        //return $result;
        return view('room.landing')
            ->with('userData', $userData)
            ->with('roomInformation', $result['roomInformation']);
    }

    public static function getShopMenu()
    {
        if ($return = PageHelper::getFromRedis('header-shop-menu')) {
            $return->fromCache = true;
            $return = json_encode($return);
        } else {
            $return = Product::getForShopMenu();
            PageHelper::putIntoRedis('header-shop-menu', $return, '+30 minutes');
        }
        return $return;
    }


    public function getSocialCounts($url = '')
    {
        $input = Input::all();

        $url = 'https://' . $input['url'];

        if (!strpos($url, 'ideaing')) {
            return 'Stop trying to hack my app, thanks';
        }

        return Sharing::getCountsFromAPIs($url);
    }


    public function updateTwitterCount($url = false)
    {
        $input = Input::all();

        if(!@$input['url']){
            return 'error';
        }
        $clear = PageHelper::deleteFromRedis('twitter-shares-' .  $input['url']);

        return 'cleared';
    }

    public function getFollowerCounts()
    {
        if ($return = PageHelper::getFromRedis('footer-follower-counts')) {
            $return->fromCache = true;
            $return = json_encode($return);
        } else {
            $return = Sharing::getFollowersFromAPIs();
            PageHelper::putIntoRedis('footer-follower-counts', $return);
        }

        return $return;
    }

    public function generateSitemap()
    {

        // create new sitemap object
        $sitemap = App::make('sitemap');

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        $sitemap->setCache('laravel.sitemap', 300, true);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {
            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add(URL::to('/'), date('c', strtotime('today')), '1.0', 'daily');

            // INFO PAGES
            $sitemap->add(URL::to('/contactus'), date('c', strtotime('1 February 2016')), '0.3', 'yearly');
            $sitemap->add(URL::to('/aboutus'), date('c', strtotime('1 February 2016')), '0.3', 'yearly');
            $sitemap->add(URL::to('/privacy-policy'), date('c', strtotime('1 February 2016')), '0.3', 'yearly');
            $sitemap->add(URL::to('/terms-of-use'), date('c', strtotime('1 February 2016')), '0.3', 'yearly');
            $sitemap->add(URL::to('/shop'), date('c', strtotime('today')), '1.0', 'daily');


            // SHOP
            $shopCategories = ProductCategory::buildCategoryTree(true);
            foreach ($shopCategories as $grandparent => $parents) {
                $sitemap->add(URL::to('/shop/' . $grandparent), date('c', strtotime('today')), '0.5', 'daily');
                foreach ($parents as $key => $parent) {
                    $sitemap->add(URL::to('/shop/' . $grandparent . '/' . $parent['childCategory']->extra_info), date('c', strtotime('today')), '0.5', 'daily');

                    foreach ($parent['grandchildCategories'] as $grandchild) {
                        $sitemap->add(URL::to('/shop/' . $grandparent . '/' . $parent['childCategory']->extra_info . '/' . $grandchild->extra_info), date('c', strtotime('today')), '0.5', 'daily');
                    }
                }
            }

            $rooms = Room::all();
            foreach ($rooms as $room) {
                $sitemap->add(URL::to('/idea/' . $room->room_permalink), date('c', strtotime('today')), '0.5', 'weekly');
            }

            $products = Product::where('post_status', 'Active')->get();
            foreach ($products as $product) {
                $sitemap->add(URL::to('/product/' . $product->product_permalink), date('c', strtotime($product->updated_at)), '0.5', 'yearly');
            }

            //CMS POSTS -- TODO -- if we wont use images in the sitemap, change into direct call to WP DB for better perf?

            $url = URL::to('/') . '/ideas/feeds/index.php?count=0';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_ENCODING, "");
            $json = curl_exec($ch);

            $posts = json_decode($json);

            //$posts = WpPost::where('post_status', 'publish')->get();
            foreach ($posts as $post) {
                $sitemap->add($post->url, date('c', strtotime($post->updated_at)), '0.5', 'yearly');
            }

        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');

    }


    public function privacyPolicy()
    {

        MetaTag::set('title', 'Privacy Policy | Ideaing');
//        MetaTag::set('description', $result['productInformation']['MetaDescription']);

        return view('info.privacy-policy');

    }


    public function contactUs()
    {

        MetaTag::set('title', 'Contact Ideaing Support Team');
//        MetaTag::set('description', $result['productInformation']['MetaDescription']);

        $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }

        return view('info.contactus')
            ->with('userData', $userData);


    }

    public function aboutUs()
    {

        MetaTag::set('title', 'About Ideaing: What We Do at Ideaing.com');
//        MetaTag::set('description', $result['productInformation']['MetaDescription']);

        //  return view('info.aboutus');

        $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }

        return view('info.aboutus')
            ->with('userData', $userData);

    }

    public function termsOfUse()
    {

        MetaTag::set('title', 'Terms of Use | Ideaing');
//        MetaTag::set('description', $result['productInformation']['MetaDescription']);

        // return view('info.terms-of-use');

        $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }

        return view('info.terms-of-use')
            ->with('userData', $userData);
    }

    public function giveaway($permalink = false)
    {

        $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }

        if ($permalink) {
            $giveaway = Giveaway::where('giveaway_permalink', $permalink)->first();
            $heading = $giveaway->giveaway_title;
        } else {
            $giveaway = Giveaway::whereDate('ends', '>=', date('Y-m-d'))->whereDate('goes_live', '<=', date('Y-m-d'))->first();
            $heading = 'Ideaing Giveaway';
        }

        $ended = false;

        if (!$giveaway) {
            $giveaway = Giveaway::whereDate('ends', '<=', date('Y-m-d'))->first();
            $ended = true;
        }

        $nextGiveaways = Giveaway::where('id', '!=', $giveaway->id)->get();

        if (!$giveaway) {
            return \Redirect::to('not-found');
        }

        if (@$userData['id'] && DB::table('giveaway_users')->where(
                [
                    'user_id' => $userData['id'],
                    'giveaway_id' => $giveaway->id,
                ]
            )->count()
        ) {
            $alreadyIn = true;
        } else {
            $alreadyIn = false;
        }

        $timeLeft = strtotime($giveaway->ends) - time();

//        $dtF = new \DateTime('@0');
//        $dtT = new \DateTime("@$timeLeft");
//        $giveaway->timeLeft = $dtF->diff($dtT)->format('%a days, %h hours and %i minutes');

        $giveaway->timeLeft = $timeLeft;


        // dd($giveaway);
        MetaTag::set('title', $heading);
        MetaTag::set('description', $giveaway->giveaway_meta_desc ?: $giveaway->giveaway_desc);

        if ($userData['method-status'] == 'fail-with-http') {
            $isAdmin = false;
            $userData['id'] = 0;
        } else {
            $isAdmin = $userData->hasRole('admin');
        }


        //  dd($giveaway,$heading);
        return view('giveaway.giveaway')
            ->with('isAdminForEdit', $isAdmin)
            ->with('userData', $userData)
            ->with('nextGiveaways', $nextGiveaways)
            ->with('giveaway', $giveaway)
            ->with('giveawayPermalink', empty($permalink) ? '' : $permalink)
            ->with('ended', $ended)
            ->with('alreadyIn', $alreadyIn)
            ->with('heading', $heading);
    }

    private function clearTemporarySessionData()
    {
        if (!empty(session('page.source.giveaway'))) {
            session(['page.source.giveaway' => null]);
        }
    }

    public function giveawayDetails($permalink)
    {
        $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }

        $giveaway = Giveaway::whereDate('permalink', $permalink)->first();

        if (!$giveaway) {
            return \Redirect::to('giveaway');
        }

        $heading = $giveaway->giveaway_title;

        if (strtotime($giveaway->ends) < time()) {
            $ended = true;
        } else {
            $ended = false;
        }

        $nextGiveaways = Giveaway::whereDate('goes_live', '>=', date('Y-m-d'))->get();

        if (@$userData['id'] && DB::table('giveaway_users')->where(
                [
                    'user_id' => $userData['id'],
                    'giveaway_id' => $giveaway->id,
                ]
            )->count()
        ) {
            $alreadyIn = true;
        } else {
            $alreadyIn = false;
        }
        // dd($giveaway);

        MetaTag::set('title', $heading);
//        MetaTag::set('description', $result['productInformation']['MetaDescription']);

        return view('giveaway.giveaway')
            ->with('userData', $userData)
            ->with('nextGiveaways', $nextGiveaways)
            ->with('giveaway', $giveaway)
            ->with('ended', $ended)
            ->with('alreadyIn', $alreadyIn)
            ->with('heading', $heading);
    }

    public function testEmail($type)
    {
        return view("email.$type")
            ->with('email', 'bob@bob.com')
//            ->with('nextGiveaways', $nextGiveaways)
//            ->with('giveaway', $giveaway)
//            ->with('ended', $ended)
//            ->with('alreadyIn', $alreadyIn)
//            ->with('heading', $heading)
            ;
    }


}
