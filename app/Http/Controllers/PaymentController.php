<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class PaymentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     */

    public function __construct()
    {
        //check user authentication and get user basic information

        $this->authCheck = $this->RequestAuthentication(array('admin', 'editor', 'user'));

        $this->payment = new Payment();

        $this->clearTemporarySessionData();
    }

    public function index()
    {
       // $userData = $this->authCheck;
        if ($this->authCheck['method-status'] == 'success-with-http') {
            $userData = $this->authCheck['user-data'];

            $invoiceData = \Config::get('const.VIP');
            $paymentType = 'membership';

            return view('payment.payment-info')
                ->with('userData',$userData)
                ->with('invoiceData',$invoiceData)
                ->with('paymentType',$paymentType);
        }else{

            MetaTag::set('title', 'Log In | Ideaing');

            return view('user.signup')->with('tab', 'login');

        }
    }

    public function paymentProcess()
    {
        $inputData = \Input::all();
        //dd('payment controller - payment process',$inputData);



        if($inputData['payment-type'] == 'membership')
        {
            $amount = \Config::get('const.VIP');
        }

        if(! empty($amount))
        {
            $userData = $this->authCheck['user-data'];

            $result = $this->payment->updateUserMembership([
                'UserId' => $userData['id'],
                'Email' => $userData['email'],
                'Plan' => 'TEST',
                'Token' => $inputData['stripeToken'],
                'MembershipType' => 'VIP',
                'Title' => 'Membership Payment',
                'Description' => 'No Description'
            ]);

            dd('controller : ',$result);

        return $result;
        }

    }

    public function cancelMembership()
    {
        $inputData = \Input::all();


            $userData = $this->authCheck['user-data'];

            $result = $this->payment->cancelMembershipSubscription([
                'UserId' => $userData['id'],
                'Email' => $userData['email'],
                'Plan' => 'TEST',

                'MembershipType' => '',
                'Title' => 'Membership Payment',
                'Description' => 'Cancel Membership'
            ]);

            dd('controller : ',$result);

            return $result;


    }

    private function clearTemporarySessionData()
    {
        if (!empty(session('page.source.giveaway'))) {
            session(['page.source.giveaway' => null]);
        }
    }

}
