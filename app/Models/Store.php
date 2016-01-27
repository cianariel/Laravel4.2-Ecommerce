<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Store extends Model {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'store';

        protected $fillable = array(
            'store_id',
            'store_name',
            'status',
            'store_description'
        );

        protected $hidden = ['created_at', 'updated_at'];


        /**
         * Define Relationship
         * /
         *
         * /*
         * @return media object
         */

        public function products()
        {
            return $this->hasMany('App\Models\Product');
        }

    }
