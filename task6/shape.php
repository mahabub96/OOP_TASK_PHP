<?php
abstract class Shape{
    abstract public function calculateArea();
    abstract public function calculatePerimeter();

    public function getShapeType(){
        return get_class($this);
    }
}

class Circle extends Shape{
    private float $radius;

    public function __construct(float $radius){
        $this->radius = $radius;
    }

    public function calculateArea(){
        return (3.1416*sqrt($this->radius));
    }

    public function calculatePerimeter(){
        return (2*3.1416*$this->radius);
    }
}


class Rectangle extends Shape{
    private float $length;
    private float $width;

    public function __construct(float $length, float $width){
        $this->length = $length;
        $this->width = $width;

    }

    public function calculateArea(){
        return $this->length*$this->width;
    }

    public function calculatePerimeter(){
        return 2*($this->length+$this->width);
    }
}


class Triangle extends Shape{
    private float $side1;
    private float $side2;
    private float $side3;

    public function __construct(float $side1,float $side2, float $side3) {
        $this->side1 = $side1;
        $this->side2 = $side2;
        $this->side3 = $side3;
    }

    public function calculatePerimeter(){
        return $this->side1+$this->side2+$this->side3;
    }

    public function calculateArea(){
        $s = $this->calculatePerimeter()/2;

        return sqrt($s*($s-$this->side1)*($s-$this->side2)*($s-$this->side3));
    }


}

?>