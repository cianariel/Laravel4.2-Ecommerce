<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Product;

    class WpUser extends \Eloquent {

        protected $connection = 'wpdb';
        protected $table = 'users';
        public $timestamps = false;


    }
