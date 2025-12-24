<?php
namespace App;

use App\Interfaces\PaymentMethod;
use App\Traits\HasId;
use App\Users\User;
use InvalidArgumentException;

class Order {
    use HasId;

    private User $user;
    private Cart $cart;
    private string $status;

    public function __construct(User $user, Cart $cart) {
        if (empty($cart->getItems())) {
            throw new InvalidArgumentException('Cannot create order with empty cart');
        }

        $this->user = $user;
        $this->cart = $cart;
        $this->status = OrderStatus::PENDING;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getCart(): Cart {
        return $this->cart;
    }

    public function getTotalAmount(): float {
        return $this->cart->getTotal();
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function pay(PaymentMethod $paymentMethod): bool {
        if ($this->status !== OrderStatus::PENDING) {
            throw new InvalidArgumentException('Order cannot be paid in current state');
        }

        $success = $paymentMethod->pay($this->getTotalAmount());

        if ($success) {
            $this->status = OrderStatus::PAID;
        }

        return $success;
    }

    public function cancel(): void {
        if ($this->status === OrderStatus::PAID) {
            throw new InvalidArgumentException('Paid order cannot be cancelled');
        }

        $this->status = OrderStatus::CANCELLED;
    }
}
?>