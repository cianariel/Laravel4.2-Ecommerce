<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Product;
    use URL;
    use Redirect;

    class Search extends \Eloquent {

        protected $connection = 'wpdb';
        protected $table = 'users';


        public static function buildIndex()
        {
//            $productSettings = [
//                'ActiveItem' => true,
//                'limit' => 20,
//                'page' => 1,
//                'CustomSkip' => 0,
//
////                'CategoryId' => $productCategoryID,
////                'sortBy' => $sortBy,
//                'FilterType' => false,
//                'FilterText' => false,
//                'ShowFor' => false,
//                'WithTags' => false,
//            ];
//
//
//            $prod = new Product();
//
//            $products = $prod->getProductList($productSettings);
//
//            return $products['result'];


            $products = Product::where('post_status', 'Active')->take(20)->get();
            foreach($products as $product){
                $data = [
                  'title' => $product->product_name,
                  'content' => $product->product_description,
                  'date_created' => $product->created_at->toDateString(),
                  'price' => $product->price,
                  'categories' => $product->productCategory->category_name,
                  'tags' => $product->tags->lists('tag_name'),
                ];

                $return[] = $data;
            }


            return $return;


        }











    }
