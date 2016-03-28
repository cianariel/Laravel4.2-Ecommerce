<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use PageHelper;
use Route;


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

            $filterCategories = ProductCategory::where('parent_id', $categoryModel->id)->get();

            if(($filterCategories->isEmpty())){
                $filterCategories = ProductCategory::where('parent_id', $categoryModel->parent_id)->get();
            }

            $categoryTree = ProductCategory::buildCategoryTree(false);
            $parentCategory =  @ProductCategory::where('id', $categoryModel->parent_id)->first();

            $masterCategory = $parentCategory ?: $categoryModel;
            switch($grandParent){
                case "smart-home":
                    $categoryModel->background_image = "/assets/images/shop-category/smarthome.jpg";
                break;
                case "travel":
                    $categoryModel->background_image = "/assets/images/shop-category/travel.jpg";
                break;
                case "wearables":
                    $categoryModel->background_image = "/assets/images/shop-category/wearables.jpg";
                break;
                case "home-decor":
                    $categoryModel->background_image = "/assets/images/shop-category/homedecor.jpg";
                break;
            }

            if(!$parent || !$child){
                if($categoryModel->parent_id && $trueParent = ProductCategory::find( $categoryModel->parent_id)){
//                    foreach($parents as $par){
                        if(!$trueParent->parent_id){
                            $key['grandparent'] = $trueParent->extra_info;
                        }else{
                            $key['parent'] = $trueParent->extra_info;
                            $key['grandparent'] = ProductCategory::find($trueParent->parent_id)->extra_info;

                        }
//                    }
                }
            }else{
                $key['parent'] = $parent;
                $key['grandparent'] = $grandParent;
            }


            $result['canonicURL'] = PageHelper::getCanonicalLink(Route::getCurrentRoute(), [$key['grandparent'] , $key['parent'], $categoryModel->extra_info]);

//            $grandParent = false, $parent = false, $child = false

            return view('shop.shop-category')
                ->with('userData',$userData)
                ->with('currentCategory', $categoryModel)
                ->with('parentCategory', $parentCategory)
                ->with('categoryTree', $categoryTree)
                ->with('grandParent', $grandParent)
                ->with('masterCategory', $masterCategory)
                ->with('filterCategories', $filterCategories)
                ->with('canonicURL', $result['canonicURL'])
            ;

        }



    }



}
