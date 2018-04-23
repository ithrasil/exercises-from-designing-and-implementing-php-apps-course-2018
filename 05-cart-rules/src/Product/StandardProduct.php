<?php

namespace Product;

use Money\Currency;
use Money\Money;
use Product;

class StandardProduct implements Product
{

    private $name, $price;

    public function __construct(string $name, int $amount)
    {
        $this->name = $name;
        $this->price = new Money($amount, new Currency('PLN'));
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function getName(): string
    {
        return $this->name;
    }
}