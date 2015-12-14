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

        protected $hidden = ['id', 'created_at', 'updated_at'];


        /**
         * Define Relationship
         * /
         *
         * /*
         *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function productCategory()
        {
            return $this->belongsTo('App\Models\ProductCategory');
        }
    }
