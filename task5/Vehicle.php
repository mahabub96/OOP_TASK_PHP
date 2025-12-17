<?php
class Vehicle {
    protected string $brand;
    protected string $model;
    protected string $year;

    public function __construct(string $brand, string $model,string $year){
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
    }

    public function getInfo(){
        echo "<br>Brand Name : ".$this->brand."<br>Model : ".$this->model."<br>Year : ".$this->year."<br>";
    }

    public function start(){
        echo "<br>From Vehicle.<br>";
    }
}

class car extends Vehicle{
    private int $numberOfDoors;

    public function __construct(string $brand, string $model,string $year,int $numberOfDoors){
        parent::__construct($brand,$model,$year);
        $this->numberOfDoors = $numberOfDoors;
    }


    public function start(){
      echo "<br> Car : ".$this->brand." model : ".$this->model." just started.<br>" ;  
    }

    public function openTrunk(){
        echo "<br> Trunk of ".$this->brand." ".$this->model." is open.<br>";
    }
}

class Motorcycle extends Vehicle{
    private bool $hasSidecar;

    public function __construct(string $brand, string $model,string $year,bool $hasSidecar){
        parent::__construct($brand,$model,$year);
        $this->hasSidecar = $hasSidecar;
    }

    public function start(){
        echo "<br>Motorcycle : ".$this->brand." model : ".$this->model." just started.<br>";
    }


    public function wheelie(){
        echo "<br> Wheelie ".$this->brand." ".$this->model." is happening.<br>";
    }


}

?>