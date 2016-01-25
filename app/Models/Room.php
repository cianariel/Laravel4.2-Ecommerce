<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

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
            'room_status',
            'hero_image_1',
            'hero_image_1_title',
            'hero_image_1_alt',
            'hero_image_1_desc',
            'hero_image_1_caption',
            'hero_image_2',
            'hero_image_2_title',
            'hero_image_2_alt',
            'hero_image_2_desc',
            'hero_image_2_caption',
            'hero_image_3',
            'hero_image_3_title',
            'hero_image_3_alt',
            'hero_image_3_desc',
            'hero_image_3_caption',
        );
        protected $hidden = ['created_at'];
        public function updateRoom($room)
        {
            try
            {

                $data = array(
                    
                );

                $roomId = $room['id'];

                Product::where('id', '=', $roomId)->update($data);

                $data = Product::where('id', $roomId)->first();

                return $data;

            } catch (Exception $ex)
            {
                return $ex;
            }
        }
    }