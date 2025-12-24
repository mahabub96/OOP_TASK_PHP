<?php
namespace App;

use App\Products\Product;
use InvalidArgumentException;

class Cart {

    private array $items = [];
    private float $taxRate = 0.10;
    private float $discount = 0.0;

    public function addItem(Product $product, int $quantity = 1): void {
        if ($quantity <= 0) {
            throw new InvalidArgumentException('Quantity must be greater than 0');
        }

        $id = $product->getId();

        if (isset($this->items[$id])) {
            $this->items[$id]['quantity'] += $quantity;
        } else {
            $this->items[$id] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }
    }

    public function removeItem(int $productId): void {
        unset($this->items[$productId]);
    }

    public function getItems(): array {
        return $this->items;
    }

    public function getSubtotal(): float {
        $subtotal = 0.0;

        foreach ($this->items as $item) {
            $subtotal += $item['product']->getPrice() * $item['quantity'];
        }

        return $subtotal;
    }

    public function applyDiscountCode(string $code): void {
        if ($code === 'SAVE10') {
            $this->discount = 0.10;
            return;
        }

        throw new InvalidArgumentException('Invalid discount code');
    }

    public function getTotal(): float {
        $subtotal = $this->getSubtotal();
        $tax = $subtotal * $this->taxRate;
        $discount = $subtotal * $this->discount;

        return ($subtotal + $tax) - $discount;
    }
}
