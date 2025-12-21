<?php
interface PaymentInterface{
    function processPayment(float $amount);
    function refund($transactionId);
}

class CreditCardPayment implements PaymentInterface{
    public function processPayment(float $amount){
        return "Creadit Card payment ".$amount." is processed<br>"; 
    }

    public function refund($transactionId){
        return "Transaction : ".$transactionId." is refunded from Credit Card<br>";
    }

}

class PayPalPayment implements PaymentInterface{
    public function processPayment(float $amount){
        return "PayPal payment ".$amount." is processed<br>"; 
    }

    public function refund($transactionId){
        return "Transaction : ".$transactionId." is refunded from PayPal<br>";
    }
}

class BankTransferPayment implements PaymentInterface{
    public function processPayment(float $amount){
        return "Bank Transfer payment ".$amount." is processed<br>"; 
    }

    public function refund($transactionId){
        return "Transaction : ".$transactionId." is refunded from Bank Transfer<br>";
    }
}

class PaymentFactory {
    public static function createPayment(string $type) : PaymentInterface{
        switch (strtolower($type)){
            case "creditcardpayment" :
                return new CreditCardPayment();
            case "paypalpayment" :
                return new PayPalPayment();
            case "banktransferpayment" :
                return new BankTransferPayment();
            default :
                throw new Exception("Invalid payment type: $type");

        }
    }
}
?>