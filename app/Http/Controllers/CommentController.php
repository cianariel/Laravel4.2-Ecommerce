<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;

use App\Models\WpPost;
use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;


class CommentController extends ApiController
{
    public function __construct()
    {
        $this->comment = new Comment();
        $this->user = new User();
    }

    // Broadcast notification to the relevant users
    public function addProductNotification($data)
    {
        $this->addNotification($data, 'product');
    }

    public function addIdeasNotification($data)
    {
        $this->addNotification($data, 'ideas');
    }


    /*public function dt()
    {

        $commnet = new \App\Models\Comment();
        return $commnet->ideasCommentCounter(2883);
    }*/

    /**
     * @param $data
     * @param $section
     * @internal param $info
     */
    private function addNotification($data,$section)
    {
        $info['Users'] = [];
        foreach ($data['CommentInfo'] as $commenter) {

            if ($commenter['UserId'] != $data['SenderId'])
                array_push($info['Users'], $commenter['UserId']);
        }
        $info['Users'] = array_unique($info['Users']);
        $info['Category'] = 'comment';//$data['Category'];
        $info['SenderId'] = $data['SenderId'];
        $info['Permalink'] = $section.'/' . $data['Permalink'] . '#comment';
        $info['PostTime'] = $data['PostTime'];
        $info['ItemTitle'] = $data['ItemTitle'];
        $info['Section'] = $section;

        $this->user->sendNotificationToUsers($info);
    }

    public function addCommentForProduct()
    {
        $inputData = \Input::all();

        if (!empty($inputData['comment']) && !empty($inputData['pid'])) {
            $data['UserId'] = $inputData['uid'];
            $data['ProductId'] = $inputData['pid'];
            $data['Comment'] = $inputData['comment'];

            $data['Link'] = $inputData['plink'];
            $data['Flag'] = 'Show';

            $result = $this->comment->addCommentForProduct($data);

            $notification['CommentInfo'] = $this->comment->findCommentForProduct(['ProductId' => $inputData['pid']]);
            $notification['SenderId'] = $inputData['uid'];
            $notification['Permalink'] = $data['Link'];

            $dataStr = date("Y-m-d H:i:s");
            $notification['PostTime'] = (string)$dataStr;

            // Add product title in the notification
            $product = Product::where('id',$inputData['pid'])->first();
            $notification['ItemTitle'] = $product['product_name'];
          //  $notification['Section'] = 'product';


            $this->addProductNotification($notification);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                        ->makeResponse($result);

        }

    }

    // add comment for ideas
    public function addCommentForIdeas()
    {
        $inputData = \Input::all();

        if (!empty($inputData['comment']) && !empty($inputData['pid'])) {
            $data['UserId'] = $inputData['uid'];
            $data['ItemId'] = $inputData['pid'];
            $data['Comment'] = $inputData['comment'];

            $data['Link'] = $inputData['plink'];
            $data['Flag'] = 'Show';

            $result = $this->comment->addCommentForIdeas($data);

            $notification['CommentInfo'] = $this->comment->findCommentForIdeas(['ItemId' => $inputData['pid']]);
            $notification['SenderId'] = $inputData['uid'];
            $notification['Permalink'] = $data['Link'];

            // $dateTime = Carbon::now();
            $dataStr = date("Y-m-d H:i:s");//$dateTime->date;
            $notification['PostTime'] = (string)$dataStr;//$data['Link'];

            // Add product title in the notification
            $product = WpPost::where('ID',$inputData['pid'])->first();
            $notification['ItemTitle'] = $product['post_title'];

            $this->addIdeasNotification($notification);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                        ->makeResponse($result);

        }

    }

    public function getCommentForProduct($pid = null)
    {
        if (!empty($pid)) {
            $data['ProductId'] = $pid;

            $result = $this->comment->findCommentForProduct($data);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                        ->makeResponse($result);

        }

    }

    public function getCommentForIdeas($pid = null)
    {
        if (!empty($pid)) {
            $data['ItemId'] = $pid;

            $result = $this->comment->findCommentForIdeas($data);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                        ->makeResponse($result);

        }

    }


    public function updateComment()
    {
        $inputData = \Input::all();

        if (!empty($inputData['comment']) && !empty($inputData['cid'])) {
            $data['Id'] = $inputData['cid'];
            $data['Comment'] = $inputData['comment'];


            $result = $this->comment->updateCommentForProduct($data);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                        ->makeResponse($result);

        }

    }

    public function deleteComment()
    {
        $inputData = \Input::all();

        if (!empty($inputData['cid'])) {
            $data['Id'] = $inputData['cid'];
            $result = $this->comment->deleteCommentForProduct($inputData['cid']);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                        ->makeResponse($result);

        }

    }


}
