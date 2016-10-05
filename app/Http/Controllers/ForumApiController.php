<?php

namespace App\Http\Controllers;

use App\Models\ForumCategory;
use App\Models\ForumThread;
use App\Models\ForumPost;

use App\Models\WpPost;
use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;


class ForumApiController extends ApiController
{
    public function __construct()
    {
        $this->categoryModel = new ForumCategory;
        $this->threadModel = new ForumThread;
        $this->postModel = new ForumPost;
        /**
        * put your comment there...
        * 
        * @var ForumApiController
        */
        $this->authCheck = $this->RequestAuthentication(array('admin', 'editor', 'user'));   
        $this->userData = $this->authCheck;

        if ($this->authCheck['method-status'] == 'success-with-http') {
            $this->userData = $this->authCheck['user-data'];
        }
//        $this->userData['email'] = "ranta@ho.com";
//        $this->userData['id'] = "42";
        /************/
    }
    
    public function getCategories($id=0){
        $categories = $this->categoryModel->where('category_id', $id)->get();
        foreach($categories as $category){
            $category['sub_categories'] = $this->categoryModel->where('category_id', $category->id)->get();
        }
        return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($categories);
    }

    public function postAddThread(Request $request)
    {
        $inputData = \Input::all();
        $this->validate($request, [
            'title'     => ['required'],
            'content'   => ['required'],
            'category_id'   => ['required']
        ]);
        $thread = array(
            "title" => $request->input('title'),
            "content" => $request->input('content'),
            "category_id" => $request->input('category_id'),
            "author_id" => $this->userData['id']
        );
        $thread = $this->threadModel->create($thread);

        return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($thread);
    }
    
    public function getThreads($category_id){
        $threads = $this->threadModel->getThreads($category_id);
        
        return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($threads);
    }

    public function getPosts($thread_id){
        $posts = $this->postModel->getPosts($thread_id);
        
        
        return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($posts);
    }
    
    public function postComment(Request $request){
        $this->validate($request, [
            'thread_id'     => ['required'],
            'post_id'   => ['required'],
            'content'   => ['required']
        ]);
        $post = $request->only(['thread_id', 'post_id', 'content']);
        $post['author_id'] = $this->userData['id'];
        
        $post = $this->postModel->create($post);
        return $this->setStatusCode(\Config::get("const.api-status.success"))
                    ->makeResponse($post);
    }
    
    

}
