<?php
namespace App\Interfaces;
interface PaymentMethod{
    public function pay(float $amount): bool;
}
?>