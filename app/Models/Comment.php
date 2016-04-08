<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
use App\Models\WpPost;

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
        return Comment::where('commentable_id', $itemId)
                      ->where('commentable_type', 'App\Models\WpPost')
                      ->count();
    }

    // Gather comment activity by user id

    public function getCommentsByUserId($userId, $count = null)
    {
        $heartProductCollection = Heart::where('user_id', $userId)
            ->where('heartable_type','App\Models\Product')
            ->get(['heartable_id']);

        dd($heartProductCollection);


        $comments = Comment::where('user_id', $userId)->whereNotNull('section');

        if ($count == null) {
            $comments = $comments->orderBy('created_at', 'desc')->get(['id', 'section', 'title', 'link', 'image_link', 'updated_at']);
        } else {
            $comments = $comments->orderBy('created_at', 'desc')->count($count)->get(['id', 'section', 'title', 'link', 'image_link', 'updated_at']);
        }

        return $comments;


    }

}
