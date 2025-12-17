<?php 
include "Vehicle.php";
$car = new car("Toyota", "Corolla", 2022, 4);
echo $car->getInfo();
echo $car->start();
echo $car->openTrunk();

$bike = new Motorcycle("Yamaha", "R1", 2021, false);
echo $bike->getInfo();
echo $bike->start();
echo $bike->wheelie();



?>