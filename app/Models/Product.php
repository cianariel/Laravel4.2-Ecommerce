<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Carbon\Carbon;

    class Product extends Model {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'products';

        //protected $fillable = ['product_name'];
        protected $fillable = array(
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

        public function medias()
        {
            return $this->morphMany('App\Models\Media', 'mediable');
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


        public function checkPermalink($permalink)
        {
            try
            {
                $product = Product::where('product_permalink', $permalink)->first();

                if ($product != null)
                    return $product;
                else
                    return false;
            } catch (\Exception $ex)
            {
                return null;
            }

        }

        public function updateProductInfo($product)
        {
            try
            {
                //ProductAuthorName: $scope.ProductAuthorName,
                $data = array(
                    "product_category_id"     => ($product['CategoryId'] != null) ? $product['CategoryId'] : null,
                    "user_name"               => ($product['ProductAuthorName'] != null) ? $product['ProductAuthorName'] : 'Anonymous User',
                    "product_name"            => $product['Name'],
                    "product_permalink"       => (isset($product['Permalink'])) ? $product['Permalink'] : null,
                    "product_description"     => ($product['Description'] != null) ? $product['Description'] : "",
                    "specifications"          => json_encode($product['Specifications']),
                    "price"                   => $product['Price'],
                    "sale_price"              => $product['SalePrice'],
                    "store_id"                => $product['StoreId'],
                    "affiliate_link"          => $product['AffiliateLink'],
                    "price_grabber_master_id" => $product['PriceGrabberId'],
                    "review"                  => json_encode($product['Review']),
                    "review_ext_link"         => $product['ExternalReviewLink'],
                    "free_shipping"           => $product['FreeShipping'],
                    "coupon_code"             => $product['CouponCode'],
                    "page_title"              => $product['PageTitle'],
                    "meta_description"        => $product['MetaDescription'],
                    "similar_product_ids"     => json_encode($product['SimilarProductIds']),
                    "product_availability"    => $product['ProductAvailability'],
                    "post_status"             => $product['PostStatus']
                );

                $productId = $product['ProductId'];

                Product::where('id', '=', $productId)->update($data);

                $data = Product::where('id', $productId)->first();

                return $data;

            } catch (Exception $ex)
            {
                return $ex;
            }

        }

        public function getSingleProductInfoForView($productId)
        {
            $result = \DB::table('products')
                ->where('products.id', $productId)
                ->leftJoin('product_categories', 'product_categories.id', '=', 'products.product_category_id')
                ->leftJoin('medias', function ($join)
                {
                    $join->on('medias.mediable_id', '=', 'products.id')
                        ->where('mediable_type', '=', 'App\Models\Product')
                        ->Where('media_type', '=', 'img-upload');
                })
                ->first(array(
                    'products.id', 'products.updated_at', 'products.user_name',
                    'products.product_name', 'product_categories.category_name', 'products.affiliate_link',
                    'products.price', 'products.sale_price', 'medias.media_link','products.product_permalink'
                ));

            return $result;

        }

        // return data for public view
        public function getViewForPublic($permalink,$id=null)
        {
            $column = $id == null?'product_permalink':'id';
            $value = $id == null?$permalink:$id;
            $productInfo = Product::with('medias')
            ->where($column,$value)
            ->first();

//dd($productInfo);
           return $productInfo;

        }

        // return all the product list as per $settings provided from the controller
        public function getProductList($settings)
        {

            $productModel = $this;

            $filterText = $settings['FilterText'];

            if ($settings['CategoryId'] != null)
            {
                $productModel = $productModel->where("product_category_id", $settings['CategoryId']);
            }

            if ($settings['ActiveItem'] == true)
            {
                $productModel = $productModel->where("post_status", 'Active');
            }

            if ($settings['FilterType'] == 'user-filter')
            {
                $productModel = $productModel->where("user_name", "like", "%$filterText%");
            }
            if ($settings['FilterType'] == 'product-filter')
            {
                $productModel = $productModel->where("product_name", "like", "%$filterText%");
            }

            $skip = $settings['limit'] * ($settings['page'] - 1);

            $product['total'] = $productModel->count();

            $product['result'] = $productModel
                ->take($settings['limit'])
                ->offset($skip)
                ->orderBy('updated_at', 'desc')
                ->get(array("id"));

            $data = array();

            $count = $product['result']->count();

            for ($i = 0; $i < $count; $i++)
            {
                $id = $product['result'][ $i ]['id'];
                $tmp = $this->getSingleProductInfoForView($id);

                // making the thumbnail url by injecting "thumb-" in the url which has been uploaded during media submission.
                $strReplace = \Config::get("const.file.s3-path");
                $path = str_replace($strReplace, '', $tmp->media_link);
                $path = $strReplace . 'thumb-' . $path;
                $tmp->media_link = $path;
                $tmp->updated_at = Carbon::createFromTimestamp(strtotime($tmp->updated_at))->diffForHumans();

                $data[ $i ] = $tmp;
            }

            $product['result'] = $data;

            return $product;
        }

        // Generating Category tree Hierarchy
        public function getCategoryHierarchy($catId)
        {
            if($catId == null)
                return null;

            $catTree = ProductCategory::where('id', $catId)->first()->getAncestorsAndSelf();

            $val = [];
            foreach ($catTree as $key => $value)
            {
                $val[ $key ]['CategoryId'] = $value->id;
                $val[ $key ]['CategoryPermalink'] = $value->extra_info;
                $val[ $key ]['CategoryName'] = $value->category_name;
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
        public function productDetailsViewGenerate($productData,$catTree)
        {
           // dd($productData);
            $productInfo['Id'] = $productData['product']->id;
            $productInfo['CategoryId'] = $productData['product']->product_category_id;
            $productInfo['CatTree'] = $catTree;
            $productInfo['ProductName'] = $productData['product']->product_name;
            $productInfo['Permalink'] = $productData['product']->product_permalink;
            $productInfo['Description'] = $productData['product']->product_description;
            $productInfo['Specifications'] = $productData['product']->specifications;
            $productInfo['Price'] = $productData['product']->price;
            $productInfo['SellPrice'] = $productData['product']->sale_price;
            $productInfo['StoreName'] = $productData['product']->store_id;
            $productInfo['AffiliateLink'] = $productData['product']->affiliate_link;
            $productInfo['Review'] = $productData['product']->review;
            $productInfo['ReviewExtLink'] = $productData['product']->review_ext_link;
            $productInfo['FreeShipping'] = $productData['product']->free_shipping;
            $productInfo['PageTitle'] = $productData['product']->page_title;
            $productInfo['MetaDescription'] = $productData['product']->meta_description;
            $productInfo['Status'] = $productData['product']->post_status;


            // setting images and hero image link
            $selfImage = [];
            foreach ($productData['product']->medias as $key => $value)
            {
                if (($value->media_type == 'img-upload' || $value->media_type == 'img-link') && ($value->is_hero_item == null || $value->is_hero_item == false))
                {
                    $selfImage['picture'][ $key ]['link'] = $value->media_link;
                    $selfImage['picture'][ $key ]['picture-name'] = $value->media_name;
                } elseif (($value->media_type == 'img-upload' || $value->media_type == 'img-link') && $value->is_hero_item == true)
                {
                    $selfImage['heroImage'] = $value->media_link;
                    $selfImage['heroImageName'] = $value->media_name;
                }
            }

            // setting information for related products
            $relatedProducts = [];
            $relatedProductsData = [];
            if ($productData['product']->similar_product_ids != "")
            {
                foreach ($productData['product']->similar_product_ids as $key => $value)
                {
                    if (!isset($value->id))
                        continue;

                    $relatedProducts[ $key ] = $this->getViewForPublic('', $value->id);
                    $tmp = $relatedProducts[ $key ];
                    $image = '';

                    foreach ($tmp->medias as $single)
                    {
                        if (($single->media_type == 'img-upload' || $single->media_type == 'img-link') && $single->is_hero_item == null)
                        {
                            $image = $single->media_link;
                            break;
                        }
                    }
                    $relatedProductsData[ $key ]['Name'] = $relatedProducts[ $key ]->product_name;
                    $relatedProductsData[ $key ]['Permalink'] = $relatedProducts[ $key ]->product_permalink;
                    $relatedProductsData[ $key ]['AffiliateLink'] = $relatedProducts[ $key ]->affiliate_link;
                    $relatedProductsData[ $key ]['Image'] = $image;
                    $relatedProductsData[ $key ]['UpdateTime'] = Carbon::createFromTimestamp(strtotime($relatedProducts[ $key ]->updated_at))->diffForHumans();
                }
            }

            $result['productInformation'] = $productInfo;
            $result['relatedProducts'] = $relatedProductsData;
            $result['selfImages'] = $selfImage;

            return $result;
        }

    }
