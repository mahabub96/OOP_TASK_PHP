<?php
namespace App\Products;

use App\Interfaces\Purchasable;
use App\Traits\HasId;
use InvalidArgumentException;

abstract class Product implements Purchasable{
    use HasId;

    protected string $name;
    protected float $price;

    public function __construct(string $name, float $price){
        if($name === ''){
            throw new InvalidArgumentException('Product name cannot be empty');
        }
        if($price<0){
            throw new InvalidArgumentException('Product price cannot be negative');
        }

        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string {
        return $this->name;
    }
    public function getPrice(): float{
        return $this->price;
    }
}


?>