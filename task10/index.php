<?php 
require "App/Controllers/ProductController.php";
require "App/Controllers/UserController.php";
require "App/Models/User.php";
require "App/Models/Product.php";
require "App/Services/EmailService.php";
require "App/Services/PaymentService.php";

use App\Models\User;
use App\Models\Product;
use App\Controllers\UserController as UC; // aliasing
use App\Services\EmailService;


$user = new User();
$product = new Product();
$userController = new UC();
$emailService = new EmailService();

// Using fully qualified name (no use statement)
$paymentService = new \App\Services\PaymentService();


echo $user->getName() ."<br>";
echo $product->getTitle() . "<br>";
echo $userController->index() ."<br>";
echo $emailService->send() . "<br>";
echo $paymentService->pay() . "<br>";



?>