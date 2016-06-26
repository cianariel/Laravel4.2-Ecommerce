<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class PaymentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //check user authentication and get user basic information

        $this->authCheck = $this->RequestAuthentication(array('admin', 'editor', 'user'));

        $this->clearTemporarySessionData();
    }

    public function index()
    {
       // $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];

            return view('payment.payment-info')->with('userData',$userData);
        }else{

            MetaTag::set('title', 'Log In | Ideaing');

            return view('user.signup')->with('tab', 'login');

        }



    }

    private function clearTemporarySessionData()
    {
        if (!empty(session('page.source.giveaway'))) {
            session(['page.source.giveaway' => null]);
        }
    }

}
