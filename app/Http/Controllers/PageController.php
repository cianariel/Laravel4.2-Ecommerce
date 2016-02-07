<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use FeedParser;
use MetaTag;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Room;

class PageController extends Controller
{
    /**
     * Display the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
//        $bob = self::getContent(1,5, 'kitchen', false);
        return view('home');
    }

    public function getContent($page = 1, $limit = 5, $tag = false,  $category = false){

        if($tag){
            $tagID = Tag::where('tag_name', $tag)->lists('id')->toArray();
        }else{
            $tagID = false;
        }

        if($limit == 'undefined' || $limit == 0){
            $productLimit = 6;
            $productOffset = 6 * ($page - 1);

            $storyLimit = 3;
            $storyOffset = 4 *  ($page - 1);

        }else{
            $productLimit = $limit;
            $storyLimit = $limit;

            $productOffset = $limit *  ($page - 1);
            $storyOffset =   $limit *  ($page - 1);
        }

        $featuredLimit = 3;
        $featuredOffset = $featuredLimit * ($page - 1);

        if($category == 'product' || !$stories = self::getStories($storyLimit, $storyOffset, $featuredLimit, $featuredOffset, $tag)){
            $stories = [
                'regular' => [],
                'featured' => [],
            ];
        }

        if($category == 'idea' || !$products = self::getProducts($productLimit, $page, $productOffset, $tagID)){
            $products['result'] = [];
        }

        if(!$stories['regular']){
            $stories['regular'] = [];
        }

        $return['regular'] = array_merge($stories['regular'], $products['result']);
        $return['featured'] = $stories['featured'];

        usort($return['regular'], function($a, $b) {
            return strtotime(@$b->updated_at) - strtotime(@$a->updated_at);
        });

        return $return;
    }

    public function getStories($limit, $offset, $featuredLimit, $featuredOffset, $tag){
        $url = 'http://staging.ideaing.com/ideas/feeds/index.php?count='.$limit.'&no-featured&offset='. $offset. '&tag=' . $tag;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING ,"");
        $json = curl_exec($ch);

        $return['regular'] = json_decode($json);

        $featuredUrl = 'http://staging.ideaing.com/ideas/feeds/index.php?count='.$featuredLimit.'&only-featured&offset='. $featuredOffset. '&tag=' . $tag;

        curl_setopt($ch, CURLOPT_URL, $featuredUrl);
        $json = curl_exec($ch);
        curl_close($ch);

        $return['featured'] = json_decode($json);

        return $return;
    }

    public function signupPage($email = '')
    {
       // dd($email);
       // isset($email)?$email= $email:$email = '';
        return view('signup')->with('email',$email);
    }

    public function getProducts($limit, $page, $offset, $tagID){
        $productSettings = [
            'ActiveItem' => true,
            'limit'      => $limit,
            'page'       => $page,
            'CustomSkip' => $offset,
            'TagId'      => $tagID,

            'CategoryId' => false,
            'FilterType' => false,
            'FilterText' => false,
            'ShowFor'    => false,
            'WithTags'   => false,
        ];

        $prod = new Product();

        $products = $prod->getProductList($productSettings);

        return $products;
    }


    public function productDetailsPage($permalink)
    {
      //  dd($this->getProducts(3,1,6));

        $product = new Product();
        $productData['product'] = $product->getViewForPublic($permalink);

        // Get category tree
        $catTree = $product->getCategoryHierarchy($productData['product']->product_category_id);

        $result = $product->productDetailsViewGenerate($productData, $catTree);

        MetaTag::set('title',$result['productInformation']['PageTitle']);
        MetaTag::set('description',$result['productInformation']['MetaDescription']);

     //   dd($result['selfImages']['picture'][0]['link']);
        return view('product.product-details')
            ->with('permalink',$permalink)
            ->with('productInformation',$result['productInformation'])
            ->with('relatedProducts',$result['relatedProducts'])
            ->with('selfImages',$result['selfImages'])
            ->with('storeInformation',$result['storeInformation']);


    }
    public function getRoomPage($permalink)
    {
        $room = new Room();
        $roomData['room'] = $room->getViewForPublic($permalink);
        $result = $room->roomDetailsViewGenerate($roomData);
        MetaTag::set('title',$result['roomInformation']['MetaTitle']);
        MetaTag::set('description',$result['roomInformation']['MetaDescription']);
        //return $result;
        return view('room.landing')->with('roomInformation',$result['roomInformation']);
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

}
