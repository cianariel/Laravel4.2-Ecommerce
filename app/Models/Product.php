<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

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

                    "product_category_id"     => $product['CategoryId'],
                    "product_name"            => $product['Name'],
                    "product_permalink"       => $product['Permalink'],
                    "product_description"     => $product['Description'],
                    "specifications"          => $product['Specifications'],
                    "price"                   => $product['Price'],
                    "sale_price"              => $product['SalePrice'],
                    "store_id"                => $product['StoreId'],
                    "affiliate_link"          => $product['AffiliateLink'],
                    "price_grabber_master_id" => $product['PriceGrabberId'],
                    "review"                  => $product['Review'],
                    "free_shipping"           => $product['FreeShipping'],
                    "coupon_code"             => $product['CouponCode'],
                    "page_title"              => $product['PageTitle'],
                    "meta_description"        => $product['MetaDescription'],
                    "similar_product_ids"     => $product['SimilarProductIds'],
                    "product_availability"    => $product['ProductAvailability'],
                );

               Product::where('id',$product['Id'])->update($data);

                return true;

            } catch (Exception $ex)
            {
                return $ex;
            }

        }

        public function publishProduct($product,$active = true)
        {


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

            $product['total'] = Product::where($whereClause)->count();//->get();
            $product['result'] = Product::where($whereClause)->take($settings['limit'])->offset($skip)->get();

            // dd($product);
            return $product;

        }


    }
