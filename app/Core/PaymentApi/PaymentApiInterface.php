<?php
/**
 * Created by PhpStorm.
 * User: tanvir
 * Date: 6/26/16
 * Time: 6:26 PM
 */


namespace App\Core\PaymentApi;


interface PaymentApiInterface
{
    public function createUser($data);
    public function chargeUser($data);

}