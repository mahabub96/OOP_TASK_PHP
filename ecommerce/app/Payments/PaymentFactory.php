<?php

namespace App\Payments;

use InvalidArgumentException;
use App\Interfaces\PaymentMethod;

class PaymentFactory
{
    public static function create(string $type): PaymentMethod
    {
        return match (strtolower($type)) {
            'paypal' => new Paypal(),
            'card'   => new CreditCard(),
            default  => throw new InvalidArgumentException('Invalid payment type'),
        };
    }
}
?>