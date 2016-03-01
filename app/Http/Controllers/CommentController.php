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

        $data['ProductId'] = 40;

        $data['Comment'] = 'new com';
        $data['UserId'] = 32;
        $data['Link'] = 'sdf.com';
        $data['Flag'] = 'new';

        $result = $this->comment->addCommentForProduct($data);

        return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($result);

    }

    public function getCommentForProduct()
    {
        $data['ProductId'] = 40;

        $result = $this->comment->findCommentForProduct($data);

        return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($result);

    }
}
