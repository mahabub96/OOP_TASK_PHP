<?php 

include "Interfaces.php";

function processPayment(Payable $worker): void {
    echo "Payment Amount: " . $worker->calculatePayment() . "<br>";
}

$employee = new Employee("Alice", 20, 40);
//echo "<br>".$employee->getId()."<br>";
$freelancer = new Freelancer("Bob", 500, 3);
//echo "<br>".$freelancer->getId()."<br>";

processPayment($employee);
processPayment($freelancer);


?>