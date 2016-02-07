<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop.index');
    }

    public function shopCategory()
    {
        return view('shop.shop-category');
    }
}
