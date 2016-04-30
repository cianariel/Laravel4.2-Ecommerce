<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
use App\Models\WpPost;
use App\Models\Heart;

use Illuminate\Support\Collection;
use Carbon\Carbon;


class Comment extends Model
{

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

    //Add comment for product
    public function addCommentForProduct($data)
    {
        $product = Product::where('id', $data['ProductId'])->first();

        $comment = new Comment();
        $comment->comment = $data['Comment'];
        $comment->user_id = $data['UserId'];
        $comment->link = $data['Link'];
        $comment->flag = $data['Flag'];
        $comment->title = $data['ItemTitle'];
        $comment->image_link = $data['Img'];
        $comment->section = 'product';

        $result = $product->comments()->save($comment);

        return $result;

    }

    //Add comment for ideas
    public function addCommentForIdeas($data)
    {
        $wpPost = WpPost::where('ID', $data['ItemId'])->first();

        $comment = new Comment();
        $comment->comment = $data['Comment'];
        $comment->user_id = $data['UserId'];
        $comment->link = $data['Link'];
        $comment->flag = $data['Flag'];
        $comment->title = $data['ItemTitle'];
        $comment->image_link = $data['Img'];
        $comment->section = 'ideas';


        $result = $wpPost->comments()->save($comment);

        return $result;

    }

    // comment search for product section
    public function findCommentForProduct($data)
    {
        $product = Product::where('id', $data['ProductId'])
                          ->with('comments')
                          ->first();

        // product_permalink
        $productComments = isset($product->comments) ? $product->comments : [];
        $commentCollection = new Collection();

        $user = new User();

        foreach ($productComments as $singleComment) {
            $userInfo = $user->getUserById($singleComment['user_id']);

            // if a user information is deleted then it will not consider it
            if ($userInfo == false)
                continue;

            $data['CommentId'] = $singleComment['id'];
            $data['Comment'] = $singleComment['comment'];
            $data['UserId'] = $userInfo['id'];
            $data['UserName'] = $userInfo['name'];
            $data['Permalink'] = $userInfo['permalink'];
            $data['Picture'] = $userInfo->medias[0]->media_link;
            $data['Flag'] = $singleComment['flag'];
            $data['PostTime'] = Carbon::createFromTimestamp(strtotime($singleComment['created_at']))->diffForHumans();

            $commentCollection->push($data);

        }

        return $commentCollection;
    }

    // comment search for ideas section
    public function findCommentForIdeas($data)
    {
        $wpPost = WpPost::where('ID', $data['ItemId'])
                        ->with('comments')
                        ->first();

        // product_permalink
        $ideasComments = isset($wpPost->comments) ? $wpPost->comments : [];
        $commentCollection = new Collection();

        $user = new User();

        foreach ($ideasComments as $singleComment) {
            $userInfo = $user->getUserById($singleComment['user_id']);

            $data['CommentId'] = $singleComment['id'];
            $data['Comment'] = $singleComment['comment'];
            $data['UserId'] = $userInfo['id'];
            $data['UserName'] = $userInfo['name'];
            $data['Permalink'] = $userInfo['permalink'];
            $data['Picture'] = $userInfo->medias[0]->media_link;
            $data['Flag'] = $singleComment['flag'];
            $data['PostTime'] = Carbon::createFromTimestamp(strtotime($singleComment['created_at']))->diffForHumans();

            $commentCollection->push($data);

        }

        return $commentCollection;
    }


    public function updateCommentForProduct($data)
    {
        $comment = Comment::where('id', $data['Id'])->update(['comment' => $data['Comment']]);

        return $comment;
    }

    public function deleteCommentForProduct($commentId)
    {
        $comment = Comment::where('id', $commentId)->delete();

        return $comment;
    }

    public function ideasCommentCounter($itemId)
    {
        $count = Comment::where('commentable_id', $itemId)
                      ->where('commentable_type', 'App\Models\WpPost')
                      ->count();
        return $count;
    }

    public function productCommentCounter($itemId)
    {
        return Comment::where('commentable_id', $itemId)
                      ->where('commentable_type', 'App\Models\Product')
                      ->count();
    }


    public function commentCounter($itemId, $section)
    {
        if ($section == 'ideas') {
            return $this->ideasCommentCounter($itemId);
        } elseif ($section == 'product') {
            return $this->productCommentCounter($itemId);
        }
    }

    // Gather comment and heart activity by user id

    public function getCommentsAndHeatByUserId($userId, $count = null)
    {

        $activityCollection = new Collection();

        $domain = \Request::root();

        $heartProductCollection = Heart::where('user_id', $userId)->where('heartable_type', 'App\Models\Product');

        if ($count == null) {
            $heartProductCollection = $heartProductCollection->orderBy('created_at', 'desc')->get(['heartable_id','updated_at']);
        } else {
            $heartProductCollection = $heartProductCollection->orderBy('created_at', 'desc')->limit($count)->get(['heartable_id','updated_at']);

        }


        $productHeatItemsId = $heartProductCollection->map(function($item){
                return $item['heartable_id'];
            });


        $productInfoOfHeart = Product::whereIn('id', $productHeatItemsId)->get(['id', 'product_name AS title', 'product_permalink AS link', 'updated_at']);

//dd($heartProductCollection);

        foreach ($productInfoOfHeart as $item) {
            $tmpCollection = new Collection();

            $tmpCollection['Id'] = $item['id'];
            $tmpCollection['Title'] = $item['title'];
            $tmpCollection['Link'] = $domain . '/product/' . $item['link'];
            $tmpCollection['Image'] = '';
            $tmpCollection['UpdateTime'] = $item['updated_at'];
            $tmpCollection['Section'] = 'product';
            $tmpCollection['Type'] = 'heart';


                foreach($heartProductCollection as $singleItem)
                {
                    if($singleItem['heartable_id'] == $item['id'])
                    {
                        $tmpCollection['UpdateTime'] = $singleItem['updated_at'];
                    }
                };

           // dd($item['id'],$tmpCollection['UpdateTime']);


            $activityCollection->push($tmpCollection);

        }



      //    dd($activityCollection);

        $heartIdeasCollection = Heart::where('user_id', $userId)->where('heartable_type', 'App\Models\WpPost');

        if ($count == null) {
            $heartIdeasCollection = $heartIdeasCollection->orderBy('created_at', 'desc')->get(['heartable_id', 'updated_at']);
        } else {
            $heartIdeasCollection = $heartIdeasCollection->orderBy('created_at', 'desc')->limit($count)->get(['heartable_id', 'updated_at']);
        }
        // dd($heartIdeasCollection);

        $ideasIdCollection = $heartIdeasCollection->map(function ($item) {
            return $item->heartable_id;
        });

        $ideasInfoOfHeart = WpPost::whereIn('ID', $ideasIdCollection)->get();

        //dd($ideasInfoOfHeart);
        foreach ($ideasInfoOfHeart as $item) {
            $tmpCollection = new Collection();

            $tmpCollection['Id'] = $item['ID'];
            $tmpCollection['Title'] = $item['post_title'];
            $tmpCollection['Link'] = $item['guid'];
            $tmpCollection['Image'] = '';//$item['image_link'];
            $tmpCollection['UpdateTime'] = $heartIdeasCollection->where('heartable_id', $item['ID'])->first()->updated_at;
            $tmpCollection['Section'] = 'ideas';
            $tmpCollection['Type'] = 'heart';

            $activityCollection->push($tmpCollection);
        }

        $comments = Comment::where('user_id', $userId)->whereNotNull('section');

        if ($count == null) {
            $comments = $comments->orderBy('created_at', 'desc')->get(['id','commentable_id', 'section', 'title', 'link', 'image_link', 'updated_at']);
        } else {
            $comments = $comments->orderBy('created_at', 'desc')->limit($count)->get(['id', 'commentable_id','section', 'title', 'link', 'image_link', 'updated_at']);
        }


        foreach ($comments as $item) {
            $tmpCollection = new Collection();

            $tmpCollection['Id'] = $item['commentable_id'];
            $tmpCollection['Title'] = $item['title'];
            $tmpCollection['Link'] = $domain . "/" . $item['section'] . "/" . $item['link'];
            $tmpCollection['Image'] = $item['image_link'];
            $tmpCollection['UpdateTime'] = $item['updated_at'];
            $tmpCollection['Section'] = $item['section'];//'product';
            $tmpCollection['Type'] = 'comment';

            $activityCollection->push($tmpCollection);

        }

        $data = $activityCollection->sortByDesc('UpdateTime')->map(function ($item) {
            return [
                'Id' => $item['Id'],
                'Title' => $item['Title'],
                'Link' => $item['Link'],
                'Image' => $item['Image'],
                'UpdateTime' => $item['UpdateTime'],
                'Section' => $item['Section'],
                'Type' => $item['Type']
            ];

        });

        $activityCollection = new Collection();

        $heart = new Heart();
        foreach ($data as $item) {
            $tmpCollection = new Collection();

            if ($item['Type'] == 'comment') {
                $commentCount = $this->commentCounter($item['Id'], $item['Section']);
            } elseif ($item['Type'] == 'heart') {

                $info = ['ItemId' => $item['Id'], 'Section' => $item['Section']];
                $heartCount = $heart->simpleHeartCounter($info);
            }

            $tmpCollection['Id'] = $item['Id'];
            $tmpCollection['Title'] = $item['Title'];
            $tmpCollection['Link'] = $item['Link'];
            $tmpCollection['Image'] = $item['Image'];
            $tmpCollection['UpdateTime'] = Carbon::createFromTimestamp(strtotime($item['UpdateTime']))->diffForHumans();
            $tmpCollection['CommentCount'] = empty($commentCount) ? 0 : $commentCount;
            $tmpCollection['HeartCount'] = empty($heartCount) ? 0 : $heartCount;

            $tmpCollection['Section'] = $item['Section'];
            $tmpCollection['Type'] = $item['Type'];


            $activityCollection->push($tmpCollection);

        }

        return $activityCollection;
    }

}
