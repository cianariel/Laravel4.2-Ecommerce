<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;


class ShopController extends ApiController
{
    public function __construct()
    {
        //check user authentication and get user basic information
        $this->authCheck = $this->RequestAuthentication(array('admin','editor','user'));

    }

    public function index($category = false)
    {

        $userData = '';
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }

        if($category){
            if(!$categoryModel = ProductCategory::where('extra_info', $category)->first()){
                return redirect('/shop/');
            }

            $parentCategoryName =  @ProductCategory::where('id', $categoryModel->parent_id)->first()->category_name;

            return view('shop.shop-category')
                ->with('userData',$userData)
                ->with('currentCategory', $category)
                ->with('parentCategory', $parentCategoryName);
        }else{
            $categoryTree = ProductCategory::buildCategoryTree();

            return view('shop.index')
                ->with('userData',$userData)
                ->with('categoryTree', $categoryTree);
        }
    }



}
