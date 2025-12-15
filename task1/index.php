<?php 
include "task1.php";
$BookA = new book("Da Vinci Code","Dan Brown",60,"12345");
$bookB= new book("The Inferno","Dan Brown",90,"34567");
$bookC = new book("The Cure","Black Mizan",75,"56789");

echo $BookA->getDetails();
echo "Price after applying discount ".$BookA->applyDiscount(10)."<br>";
echo  "Current Price ".$BookA->getPrice();


echo $bookB->getDetails();
echo $bookC->getDetails();


?>