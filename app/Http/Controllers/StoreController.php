<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StoreController extends ApiController
{

    public function __construct()
    {
        // Apply the jwt.auth middleware to all methods in this controller
        $this->middleware('jwt.auth', ['except' => ['addMediaContent','updateMediaContent']]);
        $this->store = new Store();
    }

    public function addStore()
    {
        $inputData = \Input::all();


    }




}
