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


    const br = "<br>";

   //Database connection

   $db = new Database(
    host: 'localhost',
    username: 'root',
    database: 'ecommerce',
    password: ''
   );

   $pdo = $db->connect();


   //Repositories

   $productRepo = new ProductRepository($pdo);
   $userRepo = new UserRepository($pdo);
   $orderRepo = new OrderRepository($pdo, $productRepo);

   //user

   $user = new Customer('Fahim','fahim@gmail.com');
   $userRepo->save($user);

   $laptop = new PhysicalProduct('Laptop',1000.00,2.5);
   $ebook = new DigitalProduct('PHP Ebook',30.00,'https://download.com/php');

   $productRepo->save($laptop);
   $productRepo->save($ebook);

   echo "Products created".br;


   //cart

   $cart = new Cart();
   $cart->addItem($laptop,1);
   $cart->addItem($ebook,2);

   $cart->applyDiscountCode('SAVE10');

   echo "Cart subtotal: {$cart->getSubtotal()}".br;
   echo "Cart Total: {$cart->getTotal()}".br;

   //order

   $order = new order($user, $cart);

   //payment
   $payment = PaymentFactory::create('paypal');

   if($order->pay($payment)){
    echo 'Payment Successful'.br;
   }

   //saveorder

   $orderRepo->save($order);

   echo "Order saved with ID: {$order->getId()}".br;

   //show order
   $fetchedOrder = $orderRepo->find($order->getId());
   if($fetchedOrder){
    echo "Order fetched successfully".br;
    echo "Order status: " . $fetchedOrder->getStatus() .br;
    echo "Order total: " . $fetchedOrder->getTotalAmount() .br;
   }






?>