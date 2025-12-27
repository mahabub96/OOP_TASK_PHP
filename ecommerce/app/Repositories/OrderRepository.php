<?php
namespace App\Repositories;

use PDO;
use Exception;
use App\Order;
use App\Cart;
use App\Users\User;
use App\Users\Customer;
use App\Products\Product;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;

class OrderRepository
{
    private PDO $pdo;
    private ProductRepository $productRepository;
    private UserRepository $userRepository;

    public function __construct(PDO $pdo, ProductRepository $productRepository, UserRepository $userRepository)
    {
        $this->pdo = $pdo;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Save order and its items
     */
    public function save(Order $order): void
    {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare(
                "INSERT INTO orders (user_id, total, status)
                 VALUES (:user_id, :total, :status)"
            );

            $stmt->execute([
                'user_id' => $order->getUser()->getId(),
                'total'   => $order->getTotalAmount(),
                'status'  => $order->getStatus()
            ]);

            $orderId = (int)$this->pdo->lastInsertId();
            $order->setId($orderId);

            $stmtItem = $this->pdo->prepare(
                "INSERT INTO order_items (order_id, product_id, price, quantity)
                 VALUES (:order_id, :product_id, :price, :quantity)"
            );

            foreach ($order->getCart()->getItems() as $item) {
                $product = $item['product'];

                $stmtItem->execute([
                    'order_id'   => $orderId,
                    'product_id' => $product->getId(),
                    'price'      => $product->getPrice(),
                    'quantity'   => $item['quantity']
                ]);
            }

            $this->pdo->commit();

        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    /**
     * Find order by ID
     */
    public function find(int $id): ?Order
    {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $orderRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$orderRow) {
            return null;
        }

        return $this->hydrate($orderRow);
    }

    private function hydrate(array $orderRow): Order
    {
        $user = $this->userRepository->find((int)$orderRow['user_id']);
        if (!$user) {
            $user = new Customer('Guest', 'guest@example.com', 'guest');
            $user->setId((int)$orderRow['user_id']);
        }

        $cart = new Cart();

        $stmt = $this->pdo->prepare(
            "SELECT * FROM order_items WHERE order_id = :order_id"
        );
        $stmt->execute(['order_id' => $orderRow['id']]);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = $this->productRepository->find((int)$row['product_id']);

            if ($product) {
                $cart->addItem(
                    $product,
                    (int)$row['quantity']
                );
            }
        }

        $order = new Order($user, $cart);
        $order->setId((int)$orderRow['id']);
        $order->setStatus($orderRow['status']);

        return $order;
    }
}
