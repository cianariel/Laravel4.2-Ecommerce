<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Product;

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

        public function addCommentForProduct($data)
        {
            $product = Product::where('id',$data['ProductId'])->first();

            $comment = new Comment();
            $comment->comment = $data['Comment'];
            $comment->user_id = $data['UserId'];
            $comment->link = $data['Link'];
            $comment->flag = $data['Flag'];

            $result = $product->comments()->save($comment);

            return $result;

        }

        public function findCommentForProduct($data)
        {
            $product = Product::where('id',$data['ProductId'])
            ->with();




        }





    }
