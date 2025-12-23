<?php
namespace APP;
use APP\Interfaces\PaymentMethod;
use APP\Traits\HasId;
use InvalidArgumentException;

class Order{
    use HasId;

    private Cart $cart;
    private string $status;

    public function __construct(Cart $cart){
        if (empty($cart->getItems())){
            throw new InvalidArgumentException('Cannot create order with empty cart');
        }
        $this->cart = $cart;
        $this->status = OrderStatus::PENDING;
    }

    public function getTotalAmount(): float {
        return $this->cart->getTotal();
    }

    public function getStatus(): string{
        return $this->status;
    }

    public function pay(PaymentMethod $paymentMethod): bool{
        if($this->status != OrderStatus::PENDING){
            throw new InvalidArgumentException('Order cannot be paid in current status');
        }

        $success = $paymentMethod->pay($this->getTotalAmount());

        if ($success){
            $this->status = orderStatus::PAID;
            return true;
        }

        return false;
    }
    
    public function cancel(): void{
        if($this->status === OrderStaus::PAID){
            throw new InvalidArgumentException('Paid order cannot be cancelled');
        }
        $this->status = OrderStatus::CANCELLED;
    }
}
?>