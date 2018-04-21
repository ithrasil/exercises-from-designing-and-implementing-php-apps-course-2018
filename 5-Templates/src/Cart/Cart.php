<?php

namespace Cart;

use Countable;
use Money\Currency;
use Money\Money;
use Product;

class Cart implements Countable
{
    private $products = array();

    public function count()
    {
        return count($this->products);
    }

    public function addProduct(Product $product): void
    {
        array_push($this->products, $product);
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function canIAddGift(array $criteria): string
    {
        foreach ($criteria as $criterion) {
            if ($criterion->satisfy($this)) {
                return "YES";
            }
        }
        return "NO";
    }

    public function getTotalPrice(): Money
    {
        $sum = new Money(0, new Currency('PLN'));

        foreach ($this->products as $product) {
            $sum = $sum->add($product->getPrice());
        }
        return $sum;
    }
}