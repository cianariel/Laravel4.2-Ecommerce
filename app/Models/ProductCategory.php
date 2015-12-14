<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Mockery\CountValidator\Exception;
    use Log;
    use CustomAppException;

    class ProductCategory extends Model {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'product_categories';

        protected $fillable = ['category_name','extra_info','parent_id'];

        protected $hidden = ['created_at', 'updated_at'];

        /**
         * Define Relationship
         * /
         *
         * /*
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        public function products()
        {
            return $this->hasMany('App\Models\Product');
        }


        /**  Add new item in the category and return it category object.
         * @param $product
         * @return mixed|static
         */
        public function addCategory($product)
        {

                $parentId = isset($product['ParentId'])?$product['ParentId']:null;

                // Check whether valid Parent Id provided or not for new category
                if($parentId != null)
                {
                    $parentId = $this->getParent($parentId);

                    if ($parentId == false)
                    {
                        return \Config::get("const.product-id-not-exist");
                    }
                }

                $category = ProductCategory::create([
                    'category_name' => $product['CategoryName'],
                    'extra_info'    => isset($product['ExtraInfo']) ? $product['ExtraInfo'] : null,
                    'parent_id'     => isset($product['ParentId']) ? $product['ParentId'] : null,
                ]);

                return $category;

        }

        /** Check and return a parent category , if not found return false
         * @param $parentId
         * @return bool
         */
        private function getParent($parentId)
        {
            try
            {
                return ProductCategory::where('id',$parentId)->firstOrFail();
            } catch (\Exception $ex)
            {
                return false;
            }
        }

    }
