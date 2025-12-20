<?php
include "Polymorphism.php";

$email = new EmailNotification();
$SMS = new SMSNotification();
$push = new PushNotification();


$manager = new NotificationManager();

echo $manager->notify($email,"Hello from email.");
echo $manager->notify($SMS,"Hello from SMS.");
echo $manager->notify($push,"Hello from push.");

echo $manager->notifyALL([$email,$SMS,$push],"Hello from all.");

?>