<?php 
namespace App;
use App\Interfaces\Purchasable;
use InvalidArgumentException;

class Cart {
   /** 
    *@var Purchasable[]
    */

    private array $items = [];

    private float $taxRate = 0.10;
    private float $discount = 0.0;

    public function addItem(Purchasable $item): void{
        $this->items[] = $item;
    }

    public function removeItem(int $index): void{
        if(!isset($this->items[$index])){
            throw new InvalidArgumentException('Item does not exist in cart');
        }

        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    /**
     * @return Purchasable[]
     */

    public function getItems(): array{
        return $this->items;
    }

    public function getSubtotal(): float {
        $subtotal = 0.00;

        foreach($this->items as $item){
            $subtotal += $item->getPrice();
        }

        return $subtotal;
    }

    public function applyDiscountCode(string $code):void{
        if($code === 'SAVE10'){
            $this->discount = 0.10;
            return;
        }

        throw new InvalidArgumentException('Invalid discount code');
    }

    public function getTotal(): float{
        $subtotal = $this->getSubtotal();
        $tax = $this->taxRate * $subtotal;
        $discount = $subtotal *$this->discount;

        return ($subtotal + $tax) - $discount;
    }

}
?>