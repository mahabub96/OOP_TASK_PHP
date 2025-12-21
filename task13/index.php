<?php

include "configuration.php";

$br="<br>";


$config1 = Configuration::getInstance();
$config2 = Configuration::getInstance();


$config1->set("site_name", "My Website");


echo $config2->get("site_name") .$br;


if ($config1 === $config2) {
    echo "Only one instance exists (Singleton works)." . $br;
} else {
    echo "Multiple instances exist (Singleton failed)." . $br;
}


$config1->loadFromFile("config.txt");
$config2->loadFromFile("config.txt");

echo $config1->get("port") .$br;
echo $config2->get("host") .$br;

?>
