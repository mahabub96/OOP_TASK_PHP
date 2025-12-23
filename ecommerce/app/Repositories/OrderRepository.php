<?php 
namespace App\Repositories;

use PDO;
use Exception;
use App\Orders\Order;
use App\Orders\OrderItem;
use App\Users\User;
use App\Products\Product;

class OrderRepository{
    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function save(Order $order): void{
        try{
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("INSERT INTO orders (user_id, total, status) VALUES (:user_id , :total, :status)");

            $stmt -> execute([
                'user_id' => $order->getUser()->getId(),
                'total' => $order->getTotal(),
                'status' => $order->getStatus()
            ]);

            $orderId = (int) $this->pdo->lastInsertId();
            $order->setId($orderId);
        }
    }
}
?>