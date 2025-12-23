<?php
namespace App\Payments;

use App\Interfaces\PaymentMethod;

class Paypal implements PaymentMethod{
    public function pay(float $amount):bool {
        if($amount<=0){
            return false;
        }
        return true;
    }
}
?>