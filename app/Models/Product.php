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
            'product_permalink',
            'product_description',
            'specifications',
            'price',
            'sale_price',
            'store_id',
            'affiliate_link',
            'price_grabber_master_id',
            'review',
            'free_shipping',
            'coupon_code',
            'post_status',
            'page_title',
            'meta_description',
            'similar_product_ids',
            'product_availability'
        );
        protected $hidden = ['created_at', 'updated_at'];


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
                $data = array(
                    "product_category_id"     => ($product['CategoryId'] != null) ? $product['CategoryId'] : null,
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
                    'products.price','products.sale_price','medias.media_link'
                ));

            return $result;//$responseData;

        }

        public function getProductList($settings)
        {
            $whereClause = array();
            if ($settings['CategoryId'] != null)
            {
                $whereClause = array_add($whereClause, "product_category_id", $settings['CategoryId']);
            }
            if ($settings['ActiveItem'] == true)
            {
                $whereClause = array_add($whereClause, "post_status", "Active");
            }

            $skip = $settings['limit'] * ($settings['page'] - 1);

            $product['total'] = Product::where($whereClause)->count();

            $product['result'] = Product::where($whereClause)
                ->take($settings['limit'])
                ->offset($skip)
                ->orderBy('updated_at','desc')
                ->get(array("id"));

            $data = array();

            $count = $product['result']->count();




            for ($i = 0; $i < $count; $i++)
            {
                $id = $product['result'][ $i ]['id'];
                $tmp = $this->getSingleProductInfoForView($id);

                $strReplace = \Config::get("const.file.s3-path");// "http://s3-us-west-1.amazonaws.com/ideaing-01/";
                $path = str_replace($strReplace, '', $tmp->media_link);
                $path = $strReplace.'thumb-'.$path;
                $tmp->media_link = $path;
                $tmp->updated_at = Carbon::createFromTimestamp(strtotime($tmp->updated_at))->diffForHumans();

                $data[$i] = $tmp;

            }

            $product['result'] = $data;

          //  dd($data);

            return $product;

        }


    }
