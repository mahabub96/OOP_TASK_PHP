<?php 
include "task3.php";
    $a = new BankAccount("4321","Fahim",20000);

    $a->deposit(-2000);
    $a->withdraw(-2000);
    echo "<br>".$a->getBalance();

    echo "<br>".$a->getAccountInfo();
    

    $b = new BankAccount("6255","Sakib",30000);
?>