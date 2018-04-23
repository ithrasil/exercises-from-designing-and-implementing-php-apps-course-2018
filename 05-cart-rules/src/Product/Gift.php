<?php

namespace Gift;

use Money\Money;
use Product;

class Gift implements Product
{

    private $name, $price;

    public function __construct($name, $price)
    {

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