<?php 
namespace App\Repositories;

use PDO;
use APP\Products\Product;
use APP\Products\PhysicalProduct;
use APP\Products\DigitalProduct;
use InvalidArgumentException;

class ProductRepository{
    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function save(Product $product): void {
        if($product instanceof PhysicalProduct){
            $type = 'Pysical';
            $weight = $product->getWeight();
            $downloadLink = null;
        }elseif($product instanceof DigitalProduct){
            $type = 'Digital';
            $weight = null;
            $downloadLink = $product->getDownloadLink();

        }else{
            throw new InvalidArgumentException('Unknown product type!').

        }
    }
}
?>