<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $data = ['menu'=>'dynamic menu'];*/
        return view('admin.index');
    }


    public function categoryView()
    {
        //return "hi";
        return view('admin.category-view');
    }

    public function addCategory()
    {
        return view('admin.category-add');
    }

    public function editCategory()
    {
        return view('admin.category-edit');

    }
}
