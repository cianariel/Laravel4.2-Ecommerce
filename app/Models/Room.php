<?php

    namespace App\Models;

    use App\Core\ProductApi\AmazonProductApi;
    use App\Core\ProductApi\ProductStrategy;
    use Illuminate\Database\Eloquent\Model;
    use Carbon\Carbon;

    class Room extends Model {
    	/**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'rooms';
        protected $fillable = array(
            'room_name',
            'room_permalink',
            'room_description',
            'room_status'
        );
        protected $hidden = ['created_at'];
    }