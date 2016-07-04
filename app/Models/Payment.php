<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Core\PaymentApi\PaymentStrategy;

class Payment extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments';

    protected $fillable = [
        'user_id',
        'transaction_id',
        'bill_title',
        'bill_description',
        'gateway_response',
        'active'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Define Relationship
     */

    /**
     * @return media object
     */

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // Membership Payment

    public function updateUserMembership($data)
    {
        $status = $this->membershipSubscribe($data);

        if ($status['code'] != '200') {
            return $status;
        }

        try {
            UserSetting::where('user_id', $data['UserId'])->update(['membership_type' => $data['MembershipType']]);
        } catch (\Exception $e) {
            return false;
        }

        $result = $this->savePaymentInfo([
            'UserId' => $data['UserId'],
            'Active' => 1,
            'TransactionId' => $status['data']->id,
            'Title' => $data['Title'],
            'Description' => $data['Description'],
            'Response' => json_encode($status['data'])
        ]);

        return ['data' => $result, 'code' => '200'];
    }


    public function membershipSubscribe($data)
    {
        $plan = \Config::get('const.VIP-Membership');

        $payment = new PaymentStrategy();

        $result = $payment->subscribeUser([
            'UserId' => $data['UserId'],
            'Email' => $data['Email'],
            'Token' => $data['Token'],
            'Plan' => $plan,
            'Description' => 'Membership'

        ]);

        //  dd($result);
        return $result;
    }

    public function cancelMembershipSubscription($data)
    {
        $paymentCollection = Payment::where('user_id', $data['UserId'])
            ->where('bill_title', $data['Title'])
            ->where('active',1);


        $paymentCollection->update(['active'=>0]);

        if ($paymentCollection->count()) {
            $payment = new PaymentStrategy();

            $status = $payment->cancelSubscribedUser($paymentCollection['transaction_id']);

            if ($status['code'] != '200') {
                return $status;
            }

            try {
                UserSetting::where('user_id', $data['UserId'])->update(['membership_type' => $data['MembershipType']]);
            } catch (\Exception $e) {
                return false;
            }

            $result = $this->savePaymentInfo([
                'UserId' => $data['UserId'],
                'Active' => 0,
                'TransactionId' => $status['data']->id,
                'Title' => $data['Title'],
                'Description' => $data['Description'],
                'Response' => json_encode($status['data'])
            ]);

            return ['data' => $result, 'code' => '200'];
        }

        return ['data' => 'No subscription inforamtion is available.', 'code' => '777'];

    }

    public function buyProduct($data)
    {
        $fees = \Config::get('const.VIP');

        $payment = new PaymentStrategy();

        $result = $payment->chargeUser([
            'UserId' => $data['UserId'],
            'Email' => $data['Email'],
            'Token' => $data['Token'],
            'Amount' => $fees,
            'Description' => 'Membership'

        ]);

        //  dd($result);
        return $result;
    }

    public function savePaymentInfo($data)
    {
        $payment = new Payment();

        $payment->user_id = $data['UserId'];
        $payment->active = empty($data['UserId']) ? 0 : 1;
        $payment->transaction_id = $data['TransactionId'];
        $payment->bill_title = $data['Title'];
        $payment->bill_description = $data['Description'];
        $payment->gateway_response = $data['Response'];

        $payment->save();

        return $payment;
    }


    public function checkPaymentStatus($userId)
    {
        $userToken = User::where('id', $userId)->get(['payment_token']);

        return empty($userToken) ? "" : $userToken;

    }


}
