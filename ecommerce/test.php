<?php

require __DIR__ . '/autoload.php';

use App\Database;
use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;
use App\Repositories\OrderRepository;
use App\Auth\AuthService;
use App\Cart;
use App\Products\PhysicalProduct;
use App\Payments\PaymentFactory;
use App\Order;

const BR = '<br>';

// DATABASE

$db = new Database(
    host: 'localhost',
    username: 'root',
    password: '',
    database: 'ecommerce'
);

$pdo = $db->connect();

// REPOSITORIES

$userRepository    = new UserRepository($pdo);
$productRepository = new ProductRepository($pdo);
// Fix: Pass UserRepository to OrderRepository for proper user hydration
$orderRepository   = new OrderRepository($pdo, $productRepository, $userRepository);
$authService       = new AuthService($userRepository);

// REGISTER USER (idempotent)

echo 'Registering user...' . BR;

// Fix: Avoid duplicate email error by reusing existing user if present
$existing = $userRepository->findByEmail('john@example.com');
if ($existing) {
    $user = $existing;
    echo 'User already exists with ID: ' . $user->getId() . BR;
} else {
    // Ensure password is provided to match updated User constructor and schema
    $user = $authService->register(
        name: 'John Doe',
        email: 'john@example.com',
        password: 'secret123',
        role: 'customer'
    );
    echo 'User registered with ID: ' . $user->getId() . BR;
}

// LOGIN USER

echo 'Logging in...' . BR;

$loggedInUser = $authService->login(
    email: 'john@example.com',
    password: 'secret123'
);

echo 'Logged in as: ' . $loggedInUser->getName() . ' (' . $loggedInUser->getRole() . ')' . BR;

// CART

$cart = new Cart();

// Fix: Persist products to assign real IDs and satisfy FK constraints
$product1 = new PhysicalProduct('Laptop', 1200.00, 2.5);
$productRepository->save($product1);

$product2 = new PhysicalProduct('Mouse', 50.00, 0.2);
$productRepository->save($product2);

$cart->addItem($product1, 1);
$cart->addItem($product2, 2);

$cart->applyDiscountCode('SAVE10');

echo 'Cart total: ' . $cart->getTotal() . BR;

// ORDER

$order = new Order($loggedInUser, $cart);

$payment = PaymentFactory::create('paypal');
$order->pay($payment);

$orderRepository->save($order);

echo 'Order placed successfully! Order ID: ' . $order->getId() . BR;

// FETCH ORDER

$fetchedOrder = $orderRepository->find($order->getId());

if ($fetchedOrder) {
    echo 'Order fetched successfully' . BR;
    echo 'Order status: ' . $fetchedOrder->getStatus() . BR;
    echo 'Order total: ' . $fetchedOrder->getTotalAmount() . BR;
}
