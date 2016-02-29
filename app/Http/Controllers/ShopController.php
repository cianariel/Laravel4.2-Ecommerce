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

    public function index($grandParent = false, $parent = false, $child = false)
    {

        $userData = $this->authCheck;

        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];
        }

        if(!$grandParent){ // shop landing page
            $categoryTree = ProductCategory::buildCategoryTree(true);

            return view('shop.index')
                ->with('userData',$userData)
                ->with('categoryTree', $categoryTree)
                ;
        }else{

            if($child){
                $category = $child;
            }elseif($parent){
                $category = $parent;
            }else{
                $category = $grandParent;
            }

            if(!$categoryModel = ProductCategory::where('extra_info', $category)->first()){
                return redirect('/shop/');
            }
            $categoryTree = ProductCategory::buildCategoryTree(false);
            $parentCategory =  @ProductCategory::where('id', $categoryModel->parent_id)->first();

            $masterCategory = $parentCategory ?: $categoryModel;
            switch($masterCategory->category_name){
                case "Smart Home":
                    $categoryModel->background_image = "/assets/images/shop-category/smarthome.jpg";
                break;
                case "Travel":
                    $categoryModel->background_image = "/assets/images/shop-category/travel.jpg";
                break;
                case "Wearables":
                    $categoryModel->background_image = "/assets/images/shop-category/wearables.jpg";
                break;
                case "Home Decor":
                    $categoryModel->background_image = "/assets/images/shop-category/homedecor.jpg";
                break;
            }

            return view('shop.shop-category')
                ->with('userData',$userData)
                ->with('currentCategory', $categoryModel)
                ->with('parentCategory', $parentCategory)
                ->with('categoryTree', $categoryTree)
                ->with('grandParent', $grandParent)
                ->with('masterCategory', $masterCategory)
                ;

        }



    }



}
