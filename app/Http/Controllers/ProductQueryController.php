<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\ProductQuery;

use Aws\CloudFront\Exception\Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use PageHelper;




class ProductQueryController extends ApiController
{

    public function __construct()
    {
        //check user authentication and get user basic information

        $this->authCheck = $this->RequestAuthentication(array('admin', 'editor', 'user'));

        $this->productQuery = new ProductQuery();

        $this->product = new Product();

        $this->user = new User();
    }

    public function link($userId,$productId,$reference)
    {

        $existingUser = $this->user->where('id',$userId)->count();//->first();

        $existingProduct = $this->product->where('id',$productId)->count();

        if(($reference != 'product') && ($reference != 'ideas'))
            $reference = 'product';

        if(!empty($existingUser) && !empty($existingProduct))
        {
            $result = $this->productQuery->saveProductRequest(['userId' => $userId,'productId'=>$productId,'reference'=>$reference]);

            dd($existingUser,$existingProduct,$reference,$result);
        }

        dd('exit',$existingUser,$existingProduct,$reference);


    }


}