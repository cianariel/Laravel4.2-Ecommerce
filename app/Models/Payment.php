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

    /* protected $fillable = array(
         'store_name',
         'store_identifier',
         'status',
         'store_description'
     );*/

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

    public function membershipSubscribe($data)
    {
        $fees = \Config::get('const.VIP');

        $payment = new PaymentStrategy();

        $result = $payment->chargeUser([
            'UserId' => $data['UserId'],
            'Email' => $data['Email'],
            'Token' => $data['Token'],
            'Amount' => $fees,

        ]);

        return $result;
    }

    public function savePaymentInfo($data)
    {
        $payment = new Payment();

        $payment->save([
            'user_id' => $data['UserId'],
            'transaction_id' => $data['TransactionId'],
            'bill_title' => $data['Title'],
            'bill_description' => $data['Description'],
            'gateway_response' => $data['Response']
        ]);

        return $payment;
    }

    public function updateUserMembership($data)
    {
        $status = $this->membershipSubscribe($data);

        if($status['code'] != '200')
        {
            return $status;
        }

        try {
            UserSetting::where('user_id', $data['UserId'])->update(['membership_type' => $data['MembershipType']]);
        } catch (\Exception $e) {
            return false;
        }

        $result = $this->savePaymentInfo([
            'user_id' => $data['UserId'],
            'transaction_id' => $status['TransactionId'],
            'bill_title' => $data['Title'],
            'bill_description' => $data['Description'],
            'gateway_response' => $status['body']
        ]);

        return ['data' => $result, 'code' => '200'];
    }

    public function checkPaymentStatus($userId)
    {
        $userToken = User::where('id', $userId)->get(['payment_token']);

        return empty($userToken) ? "" : $userToken;

    }


}
