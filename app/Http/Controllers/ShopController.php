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
            $categoryTree = ProductCategory::buildCategoryTree(false);
            $parentCategory =  @ProductCategory::where('id', $categoryModel->parent_id)->first();

            return view('shop.shop-category')
                ->with('userData',$userData)
                ->with('currentCategory', $categoryModel)
                ->with('parentCategory', $parentCategory)
                ->with('categoryTree', $categoryTree)
                ;
        }else{
            $categoryTree = ProductCategory::buildCategoryTree(true);

            return view('shop.index')
                ->with('userData',$userData)
                ->with('categoryTree', $categoryTree)
                ;
        }
    }



}
