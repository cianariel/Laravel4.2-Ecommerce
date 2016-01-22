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
        //URL of targeted site
        $url = "http://staging.ideaing.com/ideas/feeds/index.php?count=5&no-featured";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING ,"");

        $json = curl_exec($ch);

        $stories = json_decode($json);

        $featuredUrl = "http://staging.ideaing.com/ideas/feeds/index.php?count=3&only-featured";

        curl_setopt($ch, CURLOPT_URL, $featuredUrl);

        $json = curl_exec($ch);

        $featured = json_decode($json);

        curl_close($ch);

//        print_r($stories); die();
        // return $data;

//        $products = Product::where('post_sta')

        $productSettings = [
            'ActiveItem' => true,
            'limit'      => 6,
            'page'       => 1,
            'CategoryId' => false,
            'FilterType' => false,
            'FilterText' => false,
            'ShowFor' => false,
        ];

        $prod = new Product();

        $products = $prod->getProductList($productSettings);
        $content = array_merge($stories, $products['result']);

//        $content = array_values(array_sort($content, function ($value) {
//            if(isset($value['updated_at'])){
//                return strtotime($value['name']);
//            }else{
//                return strtotime($value['date']);
//            }
//        }));

        usort($content, function($a, $b) { return strtotime($b->updated_at) - strtotime($a->updated_at);});


        $return['row-1'] = array_slice($content, 0, 3);
        $return['row-2'] = @$featured[0] ? [$featured[0]] : false;
        $return['row-3'] = array_slice($content, 3, 3);
        $return['row-4'] = @$featured[1] ? [$featured[1]] : false;
        $return['row-5'] = array_slice($content, 6, 3);
        $return['row-6'] = @$featured[2] ? [$featured[2]] : false;

        return view('home')->with('content', $return);
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
