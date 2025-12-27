<?php 

include "Interfaces.php";

function processPayment(Payable $worker): void {
    echo "Payment Amount: " . $worker->calculatePayment() . "<br>";
}

$employee = new Employee("Alice", 20, 40);
$freelancer = new Freelancer("Bob", 500, 3);

processPayment($employee);
processPayment($freelancer);


?>