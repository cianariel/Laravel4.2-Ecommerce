<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Mockery\CountValidator\Exception;
    use Log;
    use CustomAppException;
    use Baum\Node;

//    class ProductCategory extends Model {
    class ProductCategory extends Node {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'product_categories';


        // protected $fillable = ['category_name','extra_info','parent_id'];

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

            return $this->checkProductWithinCategory(29);

            if (isset($product['ParentId']))
                return $this->addSubCategory($product);

            return ProductCategory::create(['category_name' => $product['CategoryName'],
                                            'extra_info'    => isset($product['ExtraInfo']) ? $product['ExtraInfo'] : null
            ]);
        }

        public function addSubCategory($product)
        {
            $parentNode = $this->getCategory($product['ParentId']);

            if ($parentNode == null)
                return \Config::get("const.product-id-not-exist");

            return $parentNode->children()->create(['category_name' => $product['CategoryName'],
                                                    'extra_info'    => isset($product['ExtraInfo']) ? $product['ExtraInfo'] : null
            ]);
        }

        public function getCategory($categoryId)
        {
            try
            {
                return ProductCategory::where('id', '=', $categoryId)->firstOrFail();
            } catch (\Exception $ex)
            {
                return null;
            }
        }

        public function deleteCategory($categoryId)
        {


        }

        public function checkProductWithinCategory($categoryId)
        {
            $category = $this->getCategory($categoryId)->getDescendantsAndSelf(array('id'));

            //$products = ProductCategory::find($categoryId)->products;
            dd($category);


        }


        public function addCategoryOld($product)
        {

            $root = ProductCategory::create(['category_name' => $product['CategoryName'],
                                             'extra_info'    => isset($product['ExtraInfo']) ? $product['ExtraInfo'] : null
            ]);

            //$root =ProductCategory::where('category_name','root 1');

            // $root = ProductCategory::getLeaves($root);
            // $root->getLevel(1);
            //  $node = ProductCategory::where('category_name', '=', 'root 1')->firstOrFail();

            //  $category = ProductCategory::roots()->first();
            /*
                        $node = $node->children()->create([
                            'category_name' => $product['CategoryName'],
                            'extra_info'    => isset($product['ExtraInfo']) ? $product['ExtraInfo'] : null
                        ]);*/

            //$node->

            // $node->makeRoot();

            //   return $node->getDescendantsAndSelf();
            //   $node = ProductCategory::all();


            return $root;


        }

        /*
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

      */
        /** Check and return a parent category , if not found return false
         * @param $parentId
         * @return bool
         */
        /*
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
          */


    }
