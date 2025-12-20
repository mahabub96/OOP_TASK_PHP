<?php 
require "DependencyInjection.php";

$filelogger = new FileLogger("text.txt");
$filelogger->log("Hello World");

$userServiceFile = new UserService($filelogger);
$userServiceFile->createUser("Sakib");
$userServiceFile->updateUser("Ayat");
$userServiceFile->deleteUser("Ayat");



$databselg = new DatabaseLogger();
$userService = new UserService($databselg);

$userService->createUser("Sakib");
$userService->updateUser("Ayat");
$userService->deleteUser("Ayat");
?>