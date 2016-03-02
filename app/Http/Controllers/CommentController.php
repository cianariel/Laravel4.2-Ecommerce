<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentController extends ApiController
{
    public function __construct()
    {
        $this->comment = new Comment();
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

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                        ->makeResponse($result);

        }

    }

    public function getCommentForProduct($pid = null)
    {
        if(!empty($pid))
        {
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
