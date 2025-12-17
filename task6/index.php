<?php
include "shape.php";

$circle = new Circle(5.5);
echo "<br>".$circle->getShapeType()."<br>".$circle->calculateArea()."<br>".$circle->calculatePerimeter()."<br>";

$rectangle = new Rectangle(5,10);
echo "<br>".$rectangle->getShapeType()."<br>".$rectangle->calculateArea()."<br>".$rectangle->calculatePerimeter()."<br>";

$triangle = new Triangle(5,6,7);
echo "<br>".$triangle->getShapeType()."<br>".$triangle->calculateArea()."<br>".$triangle->calculatePerimeter()."<br>";

?>