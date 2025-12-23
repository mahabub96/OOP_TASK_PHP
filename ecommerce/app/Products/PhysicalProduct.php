<?php
namespace App\Products;

use InvalidArgumentException;

class PhysicalProduct extends Product{
    private float $weight;

    public function __construct(string $name, float $price, float $weight){
        parent::__construct($name,$price);

        if($weight<=0){
            throw new InvalidArgumentException('Weight must be greater than zero');
        }

        $this->weight = $weight;
    }

    public function getWeight(): float{
        return $this->weight;
    }
}
?>