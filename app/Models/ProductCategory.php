<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class ProductCategory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_categories';

    protected $fillable = ['category_name'];

    protected $hidden = ['id','created_at','updated_at'];

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


    public function addCategory($product)
    {
        try{
        ProductCategory::create([
           'category_name' => $product['CategoryName'],
           'extra_info_elements' => $product['extra_info_elements'],
           'parent_id' => isset($product['parent_id'])? $product['parent_id']:null,
        ]);
        }catch(\Exception $ex)
        {
            throw new \Exception($ex);
        }

    }
}
