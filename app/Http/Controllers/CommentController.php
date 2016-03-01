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
}
