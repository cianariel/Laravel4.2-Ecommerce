<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;

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

    public function addProductNotification($data)
    {
        $info['Users'] = [];
        foreach ($data['CommentInfo'] as $commenter) {

            if ($commenter['UserId'] != $data['SenderId'])
                array_push($info['Users'], $commenter['UserId']);
        }
        $info['Users'] = array_unique($info['Users'] );
        $info['Category'] = 'comment';//$data['Category'];
        $info['SenderId'] = $data['SenderId'];
        $info['Permalink'] = 'product/' . $data['Permalink'] . '/#comment';
        $info['PostTime'] = $data['PostTime'];

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

            $dateTime = Carbon::now();
            $notification['PostTime'] = (string)$dateTime->date;//$data['Link'];

            $this->addProductNotification($notification);

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

    public function updateCommentForProduct()
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

    public function deleteCommentForProduct()
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
