<?php 
class BankAccount{
    private $accountNumber, $balance, $accountHolder ;

    public function __construct($accountNumber,$accountHolder,$initialBalance){
        $this->accountNumber = $accountNumber;
        $this->accountHolder = $accountHolder;
        if($initialBalance>=0){
            $this->balance = $initialBalance;
        }else{
            echo "Balance Can't be NEGATIVE.";
        }
    }

    public function deposit($amount){
        if($amount>=0){
            $this->balance += $amount;

        }else{
            echo "<br>Deposite can't be Negative ammount.<br>";
        }
    }

    public function withdraw($amount){
        if($this->balance >= $amount && $this->balance>0 && $amount >= 0){
            $this->balance -= $amount;
        }else{
            echo "<br>Dont put a negative amount or You Dont have enough balance.<br>";
        }
    }


    public function getBalance(){
        return $this->balance;
    }

    public function getAccountInfo(){
    $maskedBalance = substr($this->balance, 0, 2) . "****";
        $s = "Account Number: ".$this->accountNumber."<br> Account Holder: ".$this->accountHolder."<br> Balance : ".$maskedBalance."<br>";
        return $s;
    }
}
?>