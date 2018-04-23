<?php

namespace Product;

use IProduct;
use Money\Money;

class Product implements IProduct {
    private $id, $name, $price;

    public function __construct(int $id, string $name, Money $price) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function print(): array {
        return array
        (
            "id" => $this->id,
            "name" => $this->name,
            "money" => array
            (
                "amount" => $this->price->getAmount(),
                "currency" => $this->price->getCurrency()->getCode()
            )
        );
    }
}
