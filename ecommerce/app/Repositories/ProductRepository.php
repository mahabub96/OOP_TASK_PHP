<?php 
namespace App\Repositories;

use PDO;
use App\Products\Product;
use App\Products\PhysicalProduct;
use App\Products\DigitalProduct;
use InvalidArgumentException;

class ProductRepository{
    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function save(Product $product): void {
        if($product instanceof PhysicalProduct){
            $type = 'physical';
            $weight = $product->getWeight();
            $downloadLink = null;
        }elseif($product instanceof DigitalProduct){
            $type = 'digital';
            $weight = null;
            $downloadLink = $product->getDownloadLink();

        }else{
            throw new InvalidArgumentException('Unknown product type!');

        }
        $stmt = $this->pdo->prepare("INSERT INTO products(name,price,type,weight,download_link)
        VALUES (:name,:price,:type, :weight, :download_link)");

        $stmt->execute([
            'name'=>$product->getName(),
            'price'=>$product->getPrice(),
            'type'=>$type,
            'weight'=>$weight,
            'download_link'=>$downloadLink
        ]);

        $product->setId((int)$this->pdo->lastInsertId());
    }

    public function find(int $id): ?Product{
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");

        $stmt->execute(['id'=>$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row){
            return null;
        }

        return $this->hydrate($row);
    }

    public function findAll(): array{
        $stmt = $this->pdo->query("SELECT * FROM products");
        $products = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $products[] = $this->hydrate($row);
        }

        return $products;
    }

    private function hydrate(array $row): Product{
        if($row['type'] ==='physical'){
            $product = new PhysicalProduct($row['name'],(float)$row['price'],(float)$row['weight']);
        }elseif($row['type']==='digital'){
            $product = new DigitalProduct($row['name'],(float)$row['price'],$row['download_link']);
        }else{
            throw new InvalidArgumentException('Invalid product type in database.');
        }

        $product->setId((int)$row['id']);

        return $product;
    }
}
?>