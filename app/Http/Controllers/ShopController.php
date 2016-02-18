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
            if(!$categoryModel = ProductCategory::where('extra_info', $category)->first()){
                return redirect('/shop/');
            }

            $parentCategoryName =  @ProductCategory::where('id', $categoryModel->parent_id)->first()->category_name;

            return view('shop.shop-category')
                ->with('currentCategory', $category)
                ->with('parentCategory', $parentCategoryName)
                ;
        }else{
            $categoryTree = ProductCategory::buildCategoryTree();

            return view('shop.index')
                ->with('categoryTree', $categoryTree)
                ;
        }
    }



}
