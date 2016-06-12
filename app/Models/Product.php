<?php

namespace App\Models;

use App\Core\ProductApi\AmazonProductApi;
use App\Core\ProductApi\ProductStrategy;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\ProductCategory;
use App\Models\Tag;
use App\Models\Store;
use PageHelper;


class Product extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    protected $fillable = array(
        'product_vendor_id',
        'show_for',
        'product_name',
        'user_name',
        'product_permalink',
        'product_description',
        'specifications',
        'price',
        'sale_price',
        'store_id',
        'affiliate_link',
        'price_grabber_master_id',
        'review',
        'review_ext_link',
        'ideaing_review_score',
        'free_shipping',
        'coupon_code',
        'post_status',
        'page_title',
        'meta_description',
        'similar_product_ids',
        'product_availability'
    );
    protected $hidden = ['created_at'];


    /**
     * Define Relationship
     * /
     *
     * /*
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productCategory()
    {
        return $this->belongsTo('App\Models\ProductCategory');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function medias()
    {
        return $this->morphMany('App\Models\Media', 'mediable');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function hearts()
    {
        return $this->morphMany('App\Models\Heart', 'heartable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    public function logoInformation()
    {
        return $this->hasManyThrough('App\Models\Store', 'App\Models\Media');
    }


    public function productQueries()
    {
        return $this->hasMany('App\Models\ProductQuery');
    }


    // accessor for JSON decode
    public function getSimilarProductIdsAttribute($value)
    {
        return json_decode($value);
    }

    public function getSpecificationsAttribute($value)
    {
        return json_decode($value);
    }

    public function getReviewAttribute($value)
    {
        return json_decode($value);
    }

    // Functions //


    /** Populate store information for a single product
     * @param $productId
     * @return mixed
     */
    public function getStoreInfoByProductId($productId)
    {
        $item = Product::find($productId)->store;
        $itemLogoInfo = Store::find($item['id'])->medias->first();

        $data['StoreId'] = $item->id;
        $data['StoreName'] = $item->store_name;
        $data['Identifier'] = $item->store_identifier;
        $data['Description'] = $item->store_description;
        $data['Status'] = $item->status;
        $data['ImagePath'] = $itemLogoInfo->media_link;

        $strReplace = \Config::get("const.file.s3-path");// "http://s3-us-west-1.amazonaws.com/ideaing-01/";
        $strReplace2 = env('IMG_CDN')  . '/';

        $file = str_replace($strReplace, '', $itemLogoInfo->media_link);
        $file = str_replace($strReplace2, '', $file);

        $data['ThumbnailPath'] = env('IMG_CDN') . 'thumb-' . $file;

        return $data;
    }


    public function checkPermalink($permalink)
    {
        try {
            $product = Product::where('product_permalink', $permalink)->first();

            if ($product != null)
                return $product;
            else
                return false;
        } catch (\Exception $ex) {
            return null;
        }

    }

    public function updateProductInfo($product)
    {
        try {
            //ProductAuthorName: $scope.ProductAuthorName,
            $data = array(
                "product_category_id" => ($product['CategoryId'] != null) ? $product['CategoryId'] : env('DEFAULT_CATEGORY_ID','44'),
                "user_name" => ($product['ProductAuthorName'] != null) ? $product['ProductAuthorName'] : 'Anonymous User',
                "product_vendor_id" => $product['ProductVendorId'],
                "show_for" => ($product['ShowFor'] != null) ? $product['ShowFor'] : '',
                "product_name" => $product['Name'],
                "product_permalink" => (isset($product['Permalink'])) ? $product['Permalink'] : null,
                "product_description" => ($product['Description'] != null) ? $product['Description'] : "",
                "specifications" => json_encode($product['Specifications']),
                "price" => $product['Price'],
                "sale_price" => $product['SalePrice'],
                "store_id" => ($product['StoreId'] != null) ? $product['StoreId'] : env('DEFAULT_STORE_ID','1'),
                "affiliate_link" => $product['AffiliateLink'],
                "price_grabber_master_id" => $product['PriceGrabberId'],
                "review" => json_encode($product['Review']),
                "review_ext_link" => $product['ExternalReviewLink'],
                "ideaing_review_score" => $product['IdeaingReviewScore'],
                "free_shipping" => $product['FreeShipping'],
                "coupon_code" => $product['CouponCode'],
                "page_title" => $product['PageTitle'],
                "meta_description" => $product['MetaDescription'],
                "similar_product_ids" => json_encode($product['SimilarProductIds']),
                "product_availability" => isset($product['ProductAvailability']) ? $product['ProductAvailability'] : "",
                "post_status" => $product['PostStatus']
            );

            $productId = $product['ProductId'];

            Product::where('id', '=', $productId)->update($data);

            // delete empty product which is not containing a store id or category id ( for security check from backend)
            $this->deleteEmptyProduct();
 
            $deleted = PageHelper::deleteFromRedis('product-details-' . $data['product_permalink']);

            $data = Product::where('id', $productId)->first();

            $data['deleted'] = $deleted;

            return $data;

        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function deleteEmptyProduct()
    {
        $data = Product::where('product_category_id',null)
            ->orWhere('store_id',null);

        $data->delete();
    }

    public function getSingleProductInfoForView($productId)
    {
        $result = \DB::table('products')
                     ->where('products.id', $productId)
                     ->leftJoin('product_categories', 'product_categories.id', '=', 'products.product_category_id')
                     ->leftJoin('medias', function ($join) {
                         $join->on('medias.mediable_id', '=', 'products.id')
                              ->where('mediable_type', '=', 'App\Models\Product')
                              ->Where('media_type', '=', 'img-upload')
                              ->Where('is_main_item', '=', '1');
                     })
                     ->first(array(
                         'products.id', 'products.show_for', 'products.updated_at', 'products.product_vendor_id', 'products.store_id',//'products.product_vendor_type',
                         'products.user_name', 'products.product_name', 'product_categories.category_name', 'products.affiliate_link',
                         'products.price', 'products.sale_price', 'medias.media_link', 'products.product_permalink', 'products.post_status'
                     ));

        return $result;

    }

    // return product information data for public view
    public function getViewForPublic($permalink, $id = null)
    {
        $column = $id == null ? 'product_permalink' : 'id';
        $value = $id == null ? $permalink : $id;

        $productInfo = Product::with('medias')
                              ->where($column, $value)
                              ->first();

        // automatic update price for any changes and fetch new data with updated price
        if ($this->updateProductPrice($productInfo['product_vendor_id'], $productInfo['store_id'])) {
            $productInfo = Product::with('medias')
                                  ->where($column, $value)
                                  ->first();
        }

        return $productInfo;

    }

    // return data for public view by Name
    public function getViewForPublicByName($name)
    {

        $productInfo = Product::with('medias')
                              ->where('product_name', $name)
                              ->first();

        return $productInfo;

    }

    // return all the product list as per $settings provided from the controller
    public function getProductList($settings)
    {
        $productModel = $this;

        $filterText = $settings['FilterText'];

        if (@$settings['CategoryId'] != null) {
            if (@$settings['GetChildCategories']) {
                $catID = $settings['CategoryId'];
                $childCats = ProductCategory::where("parent_id", $catID)->lists('id');
                $grandChildCats = ProductCategory::whereIn("parent_id", $childCats)->lists('id');

                $productModel = $productModel
                    ->where("product_category_id", $settings['CategoryId'])
                    ->orWhereIn("product_category_id", $childCats)
                    ->orWhereIn("product_category_id", $grandChildCats);

            } else {
                $productModel = $productModel->where("product_category_id", $settings['CategoryId']);
            }

            if (isset($settings['TagId']) && is_array($settings['TagId'])) {
                $tagID = $settings['TagId'];
                $productModel = $productModel->orWhereHas('tags', function ($query) use ($tagID) {
                    $query->whereIn('tag_id', $tagID);
                });
            }

        } else {
            if (isset($settings['TagId']) && is_array($settings['TagId'])) {
                $tagID = $settings['TagId'];
                $productModel = $productModel->whereHas('tags', function ($query) use ($tagID) {
                    $query->whereIn('tag_id', $tagID);
                });
            }
        }

        if (@$settings['ExcludeIDs'] != null) {
            $productModel = $productModel->whereNotIn("id", $settings['excludeIDs']);
        }

        if (@$settings['ShowFor'] != null) {
            $productModel = $productModel->where("show_for", $settings['ShowFor']);
        }

        if (@$settings['ActiveItem'] == true) {
            $productModel = $productModel->where("post_status", 'Active');
        }

        if (@$settings['FilterType'] == 'user-filter') {
            $productModel = $productModel->where("user_name", "like", "%$filterText%");
        }
        if (@$settings['FilterType'] == 'product-filter') {
            $productModel = $productModel->where("product_name", "like", "%$filterText%");
        }

        if (@$settings['WithTags'] == true && $settings['CategoryId'] != null) {
            $category = ProductCategory::where('id', '=', $settings['CategoryId'])->first();

            $tag = Tag::where('tag_name', '=', $category['category_name'])->first();

            $tagModel = new Tag();

            $products = $tagModel->getProductsByTag($tag->id);

            $productIds = array();
            foreach ($products as $item) {
                array_push($productIds, $item['id']);

            }

            $productModel = $productModel->orWhereIn("id", $productIds);
        }


        $skip = isset($settings['CustomSkip']) ? intval($settings['CustomSkip']) : $settings['limit'] * ($settings['page'] - 1);


        $product['total'] = $productModel->count();

        $product['allIDs'] = $productModel
            ->take($settings['limit'])
            ->offset($skip)
            ->orderBy('created_at', 'desc')
            ->get(array("id"));

        $data = array();

        $count = $product['allIDs']->count();

        for ($i = 0; $i < $count; $i++) {
            $id = $product['allIDs'][$i]['id'];
            $tmp = $this->getSingleProductInfoForView($id);

            // making the thumbnail url by injecting "thumb-" in the url which has been uploaded during media submission.
            $strReplace =  \Config::get("const.file.s3-path");
            $strReplace2 = env('IMG_CDN')  . '/';

            $path = str_replace($strReplace, '', $tmp->media_link);
            $path = str_replace($strReplace2, '', $path);

            $path = env('IMG_CDN') . '/' . 'thumb-' . $path;

            $tmp->media_link_full_path = $tmp->media_link;

            $tmp->media_link = $path;
            $tmp->updated_at = Carbon::createFromTimestamp(strtotime($tmp->updated_at))->diffForHumans();
            $tmp->raw_creation_date = $tmp->updated_at;
            $tmp->type = 'product';

            // Add store information
            $tmp->storeInfo = $this->getStoreInfoByProductId($id);

            $data[$i] = $tmp;
        }

        $product['result'] = $data;
        $product['allIDs'] = $product['allIDs']->lists('id')->toArray();

        return $product;
    }

    // Generating Category tree Hierarchy
    public function getCategoryHierarchy($catId)
    {
        if ($catId == null)
            return null;

        try {
            $catTree = ProductCategory::where('id', $catId)->first();
            if ($catTree != null)
                $catTree = $catTree->getAncestorsAndSelf();

            $val = [];
            foreach ($catTree as $key => $value) {
                $val[$key]['CategoryId'] = $value->id;
                $val[$key]['CategoryPermalink'] = $value->extra_info;
                $val[$key]['CategoryName'] = $value->category_name;
                $val[$key]['parentPath'] = false;

                if (isset($val[$key - 1])) {
                    $parentsPath = $val[$key - 1]['CategoryPermalink'];

                    if (isset($val[$key - 2])) {
                        $parentsPath = $val[$key - 2]['CategoryPermalink'] . '/' . $parentsPath;
                    }

                    $val[$key]['parentPath'] = $parentsPath;
                }

            }
        } catch (\Exception $ex) {
            return null;
        }

        return $val;
    }

    /** Generate Core view data for product details page
     * @param $productData
     * @param $catTree
     * @return mixed
     * @internal param $productInfo
     * @internal param $result
     */
    public function productDetailsViewGenerate($productData, $catTree)
    {

        $productInfo['Id'] = $productData['product']->id;
        $productInfo['CategoryId'] = $productData['product']->product_category_id;
        $productInfo['CatTree'] = $catTree;
        $productInfo['ProductVendorId'] = $productData['product']->product_vendor_id;
        $productInfo['ProductName'] = $productData['product']->product_name;
        $productInfo['Permalink'] = $productData['product']->product_permalink;
        $productInfo['Description'] = $productData['product']->product_description;
        $productInfo['Specifications'] = $productData['product']->specifications;
        $productInfo['Price'] = number_format((float)$productData['product']->price, 2, '.', '');
        $productInfo['SellPrice'] = $productData['product']->sale_price;
        $productInfo['StoreName'] = $productData['product']->store_id;
        $productInfo['AffiliateLink'] = $productData['product']->affiliate_link;
        $productInfo['Available'] = $productData['product']->product_availability;
        $productInfo['Review'] = $productData['product']->review;
        $productInfo['ReviewExtLink'] = $productData['product']->review_ext_link;
        $productInfo['IdeaingReviewScore'] = $productData['product']->ideaing_review_score;
        $productInfo['FreeShipping'] = $productData['product']->free_shipping;
        $productInfo['PageTitle'] = $productData['product']->page_title;
        $productInfo['MetaDescription'] = $productData['product']->meta_description;
        $productInfo['Status'] = $productData['product']->post_status;


        // setting images and hero image link
        $selfImage = [];
        foreach ($productData['product']->medias as $key => $value) {
            if($value->media_type == 'video-link' || $value->media_type == 'video-youtube-link' || $value->media_type == 'video-vimeo-link'){
                $selfImage['picture'][$key]['picture-name'] = $value->media_name;
                $selfImage['picture'][$key]['type'] = $value->media_type;

               $imgData = Media::getVideoData($value->media_link, $value->media_type);

               $selfImage['picture'][$key]['preview'] = $imgData['previewLink'];
               $selfImage['picture'][$key]['link'] = $imgData['videoLink'];

            }
            elseif (($value->media_type == 'img-upload' || $value->media_type == 'img-link')
                && ($value->is_hero_item == null || $value->is_hero_item == false)
                && ($value->is_main_item == null || $value->is_main_item == false)
            ) {
                $selfImage['picture'][$key]['link'] = $value->media_link;
                $selfImage['picture'][$key]['picture-name'] = $value->media_name;
                $selfImage['picture'][$key]['type'] = $value->media_type;

            } elseif (($value->media_type == 'img-upload' || $value->media_type == 'img-link') && $value->is_hero_item == true) {
                $selfImage['heroImage'] = $value->media_link;
                $selfImage['heroImageName'] = $value->media_name;
            }
            if (($value->media_type == 'img-upload' || $value->media_type == 'img-link') && $value->is_main_item == true) {
                $selfImage['mainImage'] = $value->media_link;
                $selfImage['mainImageName'] = $value->media_name;
            }

        }

        // if main image is not selected
        if (!isset($selfImage['mainImage'])) {
            $selfImage['mainImage'] = isset($selfImage['picture'][1]['link']) ? $selfImage['picture'][1]['link'] : '';
            $selfImage['mainImageName'] = isset($selfImage['picture'][1]['picture-name']) ? $selfImage['picture'][1]['picture-name'] : '';

        }

        // setting information for related products
        $relatedProducts = [];
        $relatedProductsData = [];

        // generate related products from category
        $products = $this->populateProductsFromSameCategory($productInfo['CategoryId'], $productData['product']->similar_product_ids, $productInfo['Id']);

        if ($products != "" || $products != null) {
            foreach ($products as $key => $value) {
                if (!isset($value['id']))
                    continue;

                $relatedProducts[$key] = $this->getViewForPublic('', $value['id']);

                if ($relatedProducts[$key] == null)
                    continue;

                $tmp = $relatedProducts[$key];
                $image = '';

                foreach ($tmp->medias as $single) {
                    if (($single->media_type == 'img-upload' || $single->media_type == 'img-link') && $single->is_main_item == 1) {
                        $image = $single->media_link;
                        break;
                    }
                }

                $relatedProductsData[$key]['ItemId'] = $relatedProducts[$key]->id;
                $relatedProductsData[$key]['Name'] = $relatedProducts[$key]->product_name;
                $relatedProductsData[$key]['Permalink'] = $relatedProducts[$key]->product_permalink;
                $relatedProductsData[$key]['AffiliateLink'] = $relatedProducts[$key]->affiliate_link;
                $relatedProductsData[$key]['Image'] = $image;
                $relatedProductsData[$key]['UpdateTime'] = Carbon::createFromTimestamp(strtotime($relatedProducts[$key]->updated_at))->diffForHumans();
            }
        }

        $result['productInformation'] = $productInfo;
        $result['relatedProducts'] = $relatedProductsData;
        $result['selfImages'] = $selfImage;

        // generate store information
        $result['storeInformation'] = $this->getStoreInfoByProductId($productData['product']->id);

        //removing duplicate data entry for related product (set distinct value for related products)
        $result['relatedProducts'] = array_map("unserialize", array_unique(array_map("serialize", $result['relatedProducts'])));

        //    dd($result);
        return $result;

    }

    // populate related product data from same category

    public function populateProductsFromSameCategory($categoryId, $similarProducts, $productId, $totalItem = 3)
    {
        $settings['ActiveItem'] = false;
        $settings['CategoryId'] = $categoryId;
        $settings['FilterText'] = '';
        $settings['FilterType'] = '';

        $settings['ShowFor'] = '';

        $settings['WithTags'] = true;

        $settings['limit'] = $totalItem + 1;
        $settings['page'] = 1;

        $products = $this->getProductList($settings);

        $tmpItems = [];

        if ($similarProducts != null) {
            foreach ($similarProducts as $tmp) {
                $data['id'] = $tmp->id;
                $data['name'] = $tmp->name;
                array_push($tmpItems, $data);
            }
        }

        foreach ($products['result'] as $item) {
            if ($productId == $item->id)
                continue;

            $data['id'] = $item->id;
            $data['name'] = $item->product_name;
            array_push($tmpItems, $data);
        }

        array_splice($tmpItems, $totalItem);

        return $tmpItems;
    }


    // Get product information form Product's vendor API
    public function getApiProductInformation($itemId, $storeId = null)
    {
        try {
            $productStrategy = new ProductStrategy();

            if($storeId == null)
            {
                $product = Product::where('product_vendor_id', $itemId)->first();

                $storeId = $product['store_id'];
            }

            $store = Store::where('id', $storeId)->first();

            $result = null;

            if ($store['store_name'] == 'Amazon') {
                $productStrategy->setApiType(new AmazonProductApi());
                $result = $productStrategy->loadData($itemId);
            }

            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }


    /** Update latest price and return true, for no update return false, also return false for any system error.
     * @param string $productVendorId
     * @param string $store
     * @return bool
     */
    public function updateProductPrice($productVendorId = 'B00OHY14CS', $store = 'Amazon')
    {
        try {

            $hours = \Config::get("const.product-update-time-limit");

            $timeCompare = date("Y-m-d H:i:s", (time() - (60 * 60 * $hours)));

            $product = Product::where('updated_at', '<', $timeCompare)
                              ->where('store_id', '=', $store)
                              ->where('product_vendor_id', '=', $productVendorId)
                              ->first(array("id", "product_permalink", "price", "sale_price", "updated_at", "product_vendor_id"));

            /*

            //todo - test (withouth time limit) entity Block It After Test

            $product = Product::where('store_id', '=', $store)
                              ->where('product_vendor_id', '=', $productVendorId)
                              ->first(array("id", "product_permalink", "price", "sale_price", "updated_at", "product_vendor_id"));
            */

            if (isset($product)) {
                $apiData = $this->getApiProductInformation($productVendorId, $store);
                if (isset($apiData) && (($product['price'] != $apiData['ApiPrice']) || ($product['sale_price'] != $apiData['ApiSalePrice']))) {

                    $product->price = empty($apiData['ApiPrice'])? $product['price'] : $apiData['ApiPrice'] ;
                    $product->sale_price = empty($apiData['ApiSalePrice']) ? $product['sale_price'] : $apiData['ApiSalePrice'] ;
                    $product->save();

                }

                // Update product availability along after mentioned time span
                if(!empty($apiData))
                {
                    $product->product_availability = empty($apiData['ApiPrice'])? $product['product_availability'] : $apiData['ApiAvailable'] ;
                    $product->save();
                }

                return true;

            } else {
                return false;
            }
        } catch (Exception $ex) {
            return false;

        }
    }

    public static function getForShopMenu()
    {
        $settings = [
            'ActiveItem' => true,
            'limit' => 3,
            'page' => 1,
            'CustomSkip' => false,
            'GetChildCategories' => true,

            'CategoryId' => false,
            'FilterType' => false,
            'FilterText' => false,
            'ShowFor' => false,
            'WithTags' => false,
        ];

        $prod = new Product();

        $settings['CategoryId'] = 55;
        $travel = $prod->getProductList($settings);
        $return['travel'] = $travel['result'];
        $settings['IgnoreIDs'] = $travel['allIDs'];

        $settings['CategoryId'] = 62;
        $wearables = $prod->getProductList($settings);
        $return['wearables'] = $wearables['result'];
        $settings['IgnoreIDs'] = array_merge($settings['IgnoreIDs'], $wearables['allIDs']);

        $settings['CategoryId'] = 65;
        $homeDecor = $prod->getProductList($settings);
        $return['homeDecor'] = $homeDecor['result'];
        $settings['IgnoreIDs'] = array_merge($settings['IgnoreIDs'], $homeDecor['allIDs']);

        $settings['CategoryId'] = 44;
        $smartHome = $prod->getProductList($settings);
        $return['smartHome'] = $smartHome['result'];
        $settings['IgnoreIDs'] = array_merge($settings['IgnoreIDs'], $smartHome['allIDs']);

        $settings['CategoryId'] = 44;
        $settings['limit'] = 1;
        $mostPopular = $prod->getProductList($settings);
        $return['mostPopular'] = $mostPopular['result'];

        return $return;

    }


}
