<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use FeedParser;
use MetaTag;
use App\Models\Product;

class PageController extends Controller
{
    /**
     * Display the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $content = self::getContent();

        return view('home')->with('content', $content);
    }

    public function getContent($page = 1, $limit = 3, $returnOnly = false){
        $storyLimit = 3;
        $storyOffset = $storyLimit *  ($page - 1);

        $featuredLimit = 3;
        $featuredOffset = $featuredLimit * ($page - 1);

        $productLimit = $limit + $featuredLimit;

        if($returnOnly == 'products' || !$stories = self::getStories($storyLimit, $storyOffset, $featuredLimit, $featuredOffset)){
            $stories = [
                'regular' => [],
                'featured' => [],
            ];
        }


        if($returnOnly == 'ideas' || !$products = self::getProducts($productLimit, $page)){
            $products['result'] = [];
        }

        $return['regular'] = array_merge($stories['regular'], $products['result']);
        $return['featured'] = $stories['featured'];

        usort($return['regular'], function($a, $b) { return strtotime(@$b->updated_at) - strtotime(@$a->updated_at);});

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

    public function getProducts($limit, $page){
        $productSettings = [
            'ActiveItem' => true,
            'limit'      => $limit,
            'page'       => $page,
            'CategoryId' => false,
            'FilterType' => false,
            'FilterText' => false,
            'ShowFor' => false,
            'WithTags' => false,
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
            ->with('selfImages',$result['selfImages']);

    }

}
