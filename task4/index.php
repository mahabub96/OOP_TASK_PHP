<?php
include "task4.php";
 $a = User::create("Fahim","fahim123@gmail.com");
 echo "User count: ".User::getUserCount()."<br>";
 $b = User::create("Sakib","sakib21@gmail.com");
 echo "User count: ".User::getUserCount()."<br>";
 $c = User::create("Ayat Boss","ayatboss30@gmail.com");
 echo "User count: ".User::getUserCount()."<br>";
?>