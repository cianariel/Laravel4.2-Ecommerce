<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;


class ShopController extends Controller
{
    public function index($category = false)
    {
        if($category){

            if(!ProductCategory::where('extra_info', $category)->count()){
                return redirect('/shop/');
            }

            return view('shop.shop-category')
                ->with('currentCategory', $category)
                ;
        }else{
            $categoryTree = ProductCategory::buildCategoryTree();

            return view('shop.index')
                ->with('categoryTree', $categoryTree)
                ;
        }
    }



}
