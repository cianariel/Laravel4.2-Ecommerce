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
        $this->middleware('jwt.auth', ['except' => ['updateStore','']]);
        $this->store = new Store();
    }

    public function updateStore()
    {
        $inputData = \Input::all();
        $store = null;

        if(!isset($inputData['StorePrimaryId']))
        {
            $store = $this->store->create([
                'store_id' => $inputData['StoreID'],
                'store_name'=>$inputData['StoreName'],
                'status'=>$inputData['StoreStatus'],
                'store_description'=>$inputData['StoreDescription']
            ]);
        }else{
            $store = $this->store->where('id',$inputData['StorePrimaryId'])->first();

            $store->store_id = $inputData['StoreID'];
            $store->store_name = $inputData['StoreName'];
            $store->status = $inputData['StoreStatus'];
            $store->store_description =$inputData['StoreDescription'];
            $store->save();
        }

        $data = array(
            "media_name"   => $inputData['MediaTitle'],
            "media_type"   => $inputData['MediaType'],
            "media_link"   => $inputData['MediaLink'],
            "is_hero_item" => $inputData['IsHeroItem'],
            "is_main_item" => $inputData['IsMainItem']
        );


    }




}
