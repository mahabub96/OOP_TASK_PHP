<?php

namespace App\Interfaces;

interface Purchasable
{
    public function getName(): string;

    public function getPrice(): float;
}
?>