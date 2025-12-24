<?php
    require_once __DIR__ . '/autoload.php';
    use App\Database;
    use App\Cart;
    use App\Order;
    use App\Payments\PaymentFactory;
    use App\Products\PhysicalProduct;
    use App\Products\DigitalProduct;
    use App\Users\Customer;
    use App\Repositories\ProductRepository;
    use App\Repositories\UserRepository;
    use App\Repositories\OrderRepository;

    /**
     * 1. Database connection
     */
    $db = new Database(
        host: 'localhost',
        username: 'root',
        database: 'ecommerce',
        password: ''
    );

    $pdo = $db->connect();

    /**
     * 2. Repositories
     */
    $productRepo = new ProductRepository($pdo);
    $userRepo    = new UserRepository($pdo);
    $orderRepo   = new OrderRepository($pdo, $productRepo);

    /**
     * 3. Create User
     */
    $user = new Customer('John Doe', 'john@example.com');
    $userRepo->save($user);

    echo "User created with ID: {$user->getId()}\n";

    /**
     * 4. Create Products
     */
    $laptop = new PhysicalProduct('Laptop', 1000.00, 2.5);
    $ebook  = new DigitalProduct('PHP Ebook', 30.00, 'https://download.com/php');

    $productRepo->save($laptop);
    $productRepo->save($ebook);

    echo "Products created\n";

    /**
     * 5. Cart
     */
    $cart = new Cart();
    $cart->addItem($laptop, 1);
    $cart->addItem($ebook, 2);

    $cart->applyDiscountCode('SAVE10');

    echo "Cart subtotal: {$cart->getSubtotal()}\n";
    echo "Cart total: {$cart->getTotal()}\n";

    /**
     * 6. Order
     */
    $order = new Order($user, $cart);

    /**
     * 7. Payment
     */
    $payment = PaymentFactory::create('paypal');

    if ($order->pay($payment)) {
        echo "Payment successful\n";
    }

    /**
     * 8. Save Order
     */
    $orderRepo->save($order);

    echo "Order saved with ID: {$order->getId()}\n";

    /**
     * 9. Fetch Order
     */
    $fetchedOrder = $orderRepo->find($order->getId());

    if ($fetchedOrder) {
        echo "Order fetched successfully\n";
        echo "Order status: " . $fetchedOrder->getStatus() . "\n";
        echo "Order total: " . $fetchedOrder->getTotalAmount() . "\n";
    }

?>