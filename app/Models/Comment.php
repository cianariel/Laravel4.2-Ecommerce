<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Product;
    use App\Models\User;
    use Illuminate\Support\Collection;
    use Carbon\Carbon;


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
            ->with('comments')
            ->first();

            // product_permalink
            $productComments = $product->comments;
            $commentCollection = new Collection();

            $user = new User();

            foreach($productComments as $singleComment)
            {
                $userInfo = $user->getUserById($singleComment['user_id']);

                $data['CommentId'] = $singleComment['id'];
                $data['Comment'] = $singleComment['comment'];
                $data['UserId'] = $userInfo['id'];
                $data['UserName'] = $userInfo['name'];
                $data['Picture'] = $userInfo->medias[0]->media_link;
                $data['Flag'] = $singleComment['flag'];
                $data['PostTime'] = Carbon::createFromTimestamp(strtotime($singleComment['created_at']))->diffForHumans();

                $commentCollection->push($data);

            }

            return $commentCollection;
        }

        public function updateCommentForProduct($data)
        {
            $comment = Comment::where('id',$data['Id'])->update(['comment' => $data['Comment'] ]);

            return $comment;
        }

        public function deleteCommentForProduct($commentId)
        {
            $comment = Comment::where('id',$commentId)->delete();

            return $comment;
        }

    }
