<?php
require "PaymentFactory.php";

$obj1 = PaymentFactory::createPayment("BankTransferPayment");
$obj2 = PaymentFactory::createPayment("PayPalPayment");
$obj3 = PaymentFactory::createPayment("CreditCardPayment");


echo $obj1->processPayment(25000);
echo $obj1->refund("obj1");

echo $obj2->processPayment(20000);
echo $obj2->refund("obj2");

echo $obj3->processPayment(35000);
echo $obj3->refund("obj3");

?>