<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Media extends Model {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'medias';

        protected $fillable = array(
            'media_name',
            'media_type',
            'media_link',
            'mediable_id',
            'mediable_type'
        );
        protected $hidden = ['created_at', 'updated_at'];


        /**
         * Define Relationship
         * /
         *
         * /*
         * @return media object
         */
        public function mediable()
        {
            return $this->morphTo();
        }

    }
