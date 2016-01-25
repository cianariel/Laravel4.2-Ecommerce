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

    public function getContent($page = 1){
        $limit = 7;
        $offset = $limit *  ($page - 1);

        $url = 'http://staging.ideaing.com/ideas/feeds/index.php?count='.$limit.'&no-featured&offset='. $offset;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING ,"");

        $json = curl_exec($ch);
        $stories = json_decode($json);

        $featuredOffset = 5 * ($page - 1);

        $featuredUrl = "http://staging.ideaing.com/ideas/feeds/index.php?count=5&only-featured&offset=". $featuredOffset;

        curl_setopt($ch, CURLOPT_URL, $featuredUrl);
        $json = curl_exec($ch);
        $featured = json_decode($json);

        curl_close($ch);

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

        if(!$stories){
            $stories = [];
        }

        $products = $prod->getProductList($productSettings);
        $content = array_merge($stories, $products['result']);
//        $content = $products['result'];

        usort($content, function($a, $b) { return strtotime($b->updated_at) - strtotime($a->updated_at);});

        $return['row-1'] = array_slice($content, 0, 3);
        $return['row-2'] = @$featured[0] ? [$featured[0]] : false;
        $return['row-3'] = array_slice($content, 3, 3);
        $return['row-4'] = @$featured[1] ? [$featured[1]] : false;
        $return['row-5'] = array_slice($content, 6, 3);
        $return['row-6'] = @$featured[2] ? [$featured[2]] : false;

//        return json_encode($return);
        return $return;
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

       // dd($result['relatedProducts']);
        return view('product.product-details')
            ->with('permalink',$permalink)
            ->with('productInformation',$result['productInformation'])
            ->with('relatedProducts',$result['relatedProducts'])
            ->with('selfImages',$result['selfImages']);

    }

}
