<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Mockery\CountValidator\Exception;
    use Log;
    use CustomAppException;
    use Baum\Node;
    use Illuminate\Support\Collection;

//    class ProductCategory extends Model {
    class ProductCategory extends Node {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'product_categories';


        // protected $fillable = ['category_name','extra_info','parent_id'];

        protected $hidden = ['lft', 'rgt', 'depth', 'created_at', 'updated_at'];

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

        public function getAllRootCategory()
        {
            try
            {
                $data = ProductCategory::where('parent_id', '=', null)->get();

                $rootCategories = collect();
                foreach ($data as $key => $value)
                {
                    $rootCategories->push(['id' => $value->id, 'category' => $value->category_name, 'info' => $value->extra_info]);
                }

                return $rootCategories;

            } catch (\Exception $ex)
            {
                return null;
            }

        }

        public function updateCategoryInfo($categoryOld)
        {
            $category = $this->getCategory($categoryOld['CategoryId']);

            if ($category != null)
            {
                $category->category_name = $categoryOld['CategoryName'];
                $category->extra_info = $categoryOld['ExtraInfo'];
                $category->save();

                return \Config::get("const.category-updated");

            } else
            {
                return \Config::get("const.category-not-exist");
            }

        }


        public function deleteCategory($categoryId)
        {
            $products = $this->productWithinCategory($categoryId);
            if ($products->count() > 0)
            {
                return \Config::get("const.category-delete-exists");

            } else
            {
                $category = $this->getCategory($categoryId);
                $category->delete();

                return \Config::get("const.category-delete");
            }
        }

        public function productWithinCategory($categoryId)
        {
            $categories = $this->getCategory($categoryId)->getDescendantsAndSelf(array('id'));

            //$products = ProductCategory::find($categoryId)->products;

            $categoryList = collect([]);
            foreach ($categories as $key => $value)
            {
                $categoryList->push($value->id);
            }

            return Product::whereIn('product_category_id', $categoryList)->get();
            //  $products = Product::whereIn('product_category_id', $categoryList)->get();

            // dd($products->count());


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
