<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use FeedParser;
use MetaTag;
use App\Models\Product;
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
//        for($i = 0; $i < $pages; $i++){
//            $content[] = self::getContent($i + 1);
//        }

        return view('home');
    }

    public function getContent($page = 1, $limit = 5, $returnOnly = false, $offset = false){

        $offset = false;

        if((!$offset || $offset == 'undefined') && ($limit == 'undefined' || $limit == 0)){
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



//        if($returnOnly == 'idea'){
//            $productLimit = $limit;
//        }

        $featuredLimit = 3;
        $featuredOffset = $featuredLimit * ($page - 1);

//        if($returnOnly == 'product'){
//            $productLimit  = $limit;
//            $productOffset = $limit *  ($page);
//        }else{
//            $productLimit = $limit + 2;
//            $productOffset = $limit *  ($page - 1);
//        }
//        $productOffset = $limit;

        if($returnOnly == 'product' || !$stories = self::getStories($storyLimit, $storyOffset, $featuredLimit, $featuredOffset)){
            $stories = [
                'regular' => [],
                'featured' => [],
            ];
        }

        if($returnOnly == 'idea' || !$products = self::getProducts($productLimit, $page, $productOffset)){
            $products['result'] = [];
        }

        $return['regular'] = array_merge($stories['regular'], $products['result']);
        $return['featured'] = $stories['featured'];

        usort($return['regular'], function($a, $b) {
            return strtotime(@$b->updated_at) - strtotime(@$a->updated_at);
        });

        return $return;
    }

    public function getStories($limit, $offset, $featuredLimit, $featuredOffset){
        $url = 'http://staging.ideaing.com/ideas/feeds/index.php?count='.$limit.'&no-featured&offset='. $offset;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING ,"");
        $json = curl_exec($ch);

        $return['regular'] = json_decode($json);

        $featuredUrl = 'http://staging.ideaing.com/ideas/feeds/index.php?count='.$featuredLimit.'&only-featured&offset='. $featuredOffset;

        curl_setopt($ch, CURLOPT_URL, $featuredUrl);
        $json = curl_exec($ch);
        curl_close($ch);

        $return['featured'] = json_decode($json);

        return $return;
    }

    public function getProducts($limit, $page, $offset){
        $productSettings = [
            'ActiveItem' => true,
            'limit'      => $limit,
            'page'       => $page,
            'CustomSkip' => $offset,

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
        return view('static.kitchen-landing')->with('roomInformation',$result['roomInformation']);
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
