<?php

namespace Criterion;

use Cart\Cart;
use Criterion;

class QuantityRule implements Criterion {
    private $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function satisfy(Cart $cart)
    {
        return count($cart) > $this->quantity;
    }

}