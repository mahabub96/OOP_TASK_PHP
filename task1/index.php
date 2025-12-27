<?php 
include "task1.php";
$BookA = new book("Da Vinci Code","Dan Brown",100,"12345");
$bookB= new book("The Inferno","Dan Brown",90,"34567");
$bookC = new book("The Cure","Black Mizan",75,"56789");

$d=10;

echo $BookA->getDetails();
$BookA->applyDiscount($d);
echo "Discounted ammount : ".$BookA->getDprice()."<br>";
echo "Price After ".$d."% Discount : ".$BookA->getPrice()."<br>";


echo $bookB->getDetails();
echo $bookC->getDetails();


?>