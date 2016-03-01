<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Comment extends Model {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'comments';

        /*protected $fillable = array(
            'store_name',
            'store_identifier',
            'status',
            'store_description'
        );*/

        protected $hidden = ['created_at', 'updated_at'];


        /**
         * Define Relationship
         * /
         *
         * /*
         * @return media object
         */

        public function commentable()
        {
            return $this->morphTo();
        }



        // custom Functions

        public function addComment($parent)
        {

        }

        public function findOrAddCommentForProduct($data)
        {



        }



    }
