<?php 
include "Product.php";

$product = new product();

$product->name = "Ballons";
$product->id = "20";

echo $product->name."<br>";

if(isset($product->id)){
    echo "Id is set<br>";
}

$product->showresult();


echo $product;
?>