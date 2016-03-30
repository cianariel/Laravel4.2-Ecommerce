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
use App\Models\HomeHero;
use App\Models\Giveaway;
use URL;
use Input;
use App\Models\Sharing;
use Sitemap;
use PageHelper;
use Route;

class PageController extends ApiController
{

    public function __construct()
    {
        //check user authentication and get user basic information

        $this->authCheck = $this->RequestAuthentication(array('admin', 'editor', 'user'));
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
        //return $result;
        return view('home')->with('userData', $userData)->with('homehero', $result);
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

    public function getGridContent($page = 1, $limit = 5, $tag = false, $type = false, $ideaCategory = false)
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

        if ($type == 'product' || !$stories = self::getGridStories($storyLimit, $storyOffset, $featuredLimit, $featuredOffset, $tag, $ideaCategory)) {
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
        if (env('FEED_PROD') == true)
            $url = 'https://ideaing.com/ideas/feeds/index.php?count=' . $limit . '&offset=' . $offset;
        else
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

       // echo $json;
        //die();

      //  $return = json_decode($json);

        $ideaCollection = json_decode($json);

        $newIdeaCollection = new Collection();
        $comment = new App\Models\Comment();

        if($ideaCollection){

            foreach ($ideaCollection as $singleIdea) {

                $tempIdea = collect($singleIdea);

                $countValue = $comment->ideasCommentCounter($singleIdea->id);

                $tempIdea->put('CommentCount', $countValue);

                $newIdeaCollection->push($tempIdea);

            }
        }


        return $newIdeaCollection->toArray();//$return;
    }


    public function getGridStories($limit, $offset, $featuredLimit, $featuredOffset, $tag = false, $category = false)
    {

        if (env('FEED_PROD') == true)
            $url = 'https://ideaing.com/ideas/feeds/index.php?count=' . $limit . '&no-featured&offset=' . $offset;
        else
            $url = URL::to('/') . '/ideas/feeds/index.php?count=' . $limit . '&no-featured&offset=' . $offset;

        if ($tag && $tag != 'false') {
            $url .= '&tag=' . $tag;
        }

        if ($category && $category != 'false') {
            $url .= '&category-name=' . $category;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        $json = curl_exec($ch);

        $return['regular'] = json_decode($json);


        if (env('FEED_PROD') == true)
            $featuredUrl = 'https://ideaing.com/ideas/feeds/index.php?count=' . $featuredLimit . '&only-featured&offset=' . $featuredOffset . '&tag=' . $tag;
        else
            $featuredUrl = URL::to('/') . '/ideas/feeds/index.php?count=' . $featuredLimit . '&only-featured&offset=' . $featuredOffset . '&tag=' . $tag;


        if ($tag && $tag != 'false' && $tag != false) {
            $featuredUrl .= '&tag=' . $tag;
        }

//                print_r($featuredUrl); die();
        // print_r($return); die();


        curl_setopt($ch, CURLOPT_URL, $featuredUrl);
        $json = curl_exec($ch);
        curl_close($ch);

        // $return['featured'] = json_decode($json);

        $ideaCollection = json_decode($json);

        $newIdeaCollection = new Collection();
        $comment = new App\Models\Comment();

        if($ideaCollection){

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
        if (env('FEED_PROD') == true)
            $url = 'https://ideaing.com/ideas/feeds/index.php?count=' . $limit;
        else
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
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        $json = curl_exec($ch);

        $return = json_decode($json);

        return $return;
    }

    public function signupPage($email = '')
    {
        MetaTag::set('title', 'Sign Up | Ideaing');

        return view('signup')->with('email', $email)->with('tab', 'signup');
    }

    public function loginView()
    {
        MetaTag::set('title', 'Log In | Ideaing');

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

        // todo - check login user and implement mark as reade notification for the user

        if (isset($userData['id'])) {
            $user = new User();

            //    $tmpPermalink = 'product/' . $permalink . '/#comment';

            //    $user->markNotificationAsRead(['UserId'=>$userData['id'],'Permalink' => $tmpPermalink]);

        }


        // Get category tree
        $catTree = $product->getCategoryHierarchy($productData['product']->product_category_id);

        $result = $product->productDetailsViewGenerate($productData, $catTree);

//        $currentTag = [];
        $currentTags = Product::find($productData['product']['id'])->tags()->lists('tag_id');

//        $tagNames = [];
        foreach ($currentTags as $tagID) {
            $tagNames[] = Tag::find($tagID)->tag_name;
        }

        @$relatedIdeas = self::getRelatedStories($productData['product']['id'], 3, $tagNames);

//        $related

        MetaTag::set('title', $result['productInformation']['PageTitle']);
        MetaTag::set('description', $result['productInformation']['MetaDescription']);

        //   dd($result['selfImages']['picture'][0]['link']);


        if ($userData['method-status'] == 'fail-with-http') {
            $isAdmin = false;
            $userData['id'] = 0;
        } else {
            $isAdmin = $userData->hasRole('admin');
        }

        $result['canonicURL'] = PageHelper::getCanonicalLink(Route::getCurrentRoute(), $permalink);
//        $result['metaDescription'] = PageHelper::formatForMetaDesc($product->product_description);

        return view('product.product-details')
            ->with('isAdminForEdit', $isAdmin)
            ->with('productId', $productData['product']['id'])
            ->with('userData', $userData)
            ->with('permalink', $permalink)
            ->with('productInformation', $result['productInformation'])
            ->with('relatedProducts', $result['relatedProducts'])
            ->with('relatedIdeas', $relatedIdeas)
            ->with('selfImages', $result['selfImages'])
            ->with('storeInformation', $result['storeInformation'])
            ->with('canonicURL', $result['canonicURL'])
            ->with('MetaDescription', $result['productInformation']['MetaDescription'])
            ;
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
        $return = Product::getForShopMenu();
        return $return;
    }


    public function getSocialCounts($url = '')
    {
        $input = Input::all();

        $url = 'https://' . $input['url'];

        if (!strpos($url, 'ideaing')) { // TODO - make more strict check on Production
            return 'Stop trying to hack my app, thanks';
        }

        return Sharing::getCountsFromAPIs($url);
    }

    public function getFollowerCounts()
    {
        return Sharing::getFollowersFromAPIs();
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
            if (env('FEED_PROD') == true)
                $url = 'https://ideaing.com/ideas/feeds/index.php?count=0';
            else
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
        return view('layouts.privacy-policy');
    }
    public function contactUs()
    {
        MetaTag::set('title', 'Contact us | Ideaing');
//        MetaTag::set('description', $result['productInformation']['MetaDescription']);
        return view('contactus.index');
    }
    public function aboutUs()
    {
        MetaTag::set('title', 'About us | Ideaing');
//        MetaTag::set('description', $result['productInformation']['MetaDescription']);
        return view('layouts.aboutus');
    }

    public function termsOfUse()
    {
        MetaTag::set('title', 'Terms of Use | Ideaing');
//        MetaTag::set('description', $result['productInformation']['MetaDescription']);
        return view('layouts.terms-of-use');
    }
    public function giveaway()
    {
        MetaTag::set('title', 'Giveaway | Ideaing');
//        MetaTag::set('description', $result['productInformation']['MetaDescription']);
        $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }
        $giveaway = Giveaway::where('giveaway_status', 1)->first();
        return view('giveaway.giveaway')->with('userData', $userData)->with('giveaway',$giveaway);
    }
    
}
