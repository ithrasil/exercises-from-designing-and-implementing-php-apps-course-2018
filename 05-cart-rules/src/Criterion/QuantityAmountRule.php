<?php

namespace Criterion;

use Cart\Cart;
use Criterion;

class QuantityAmountRule implements Criterion {
    private $quantity, $amount;

    public function __construct(int $quantity, int $amount)
    {
        $this->quantity = $quantity;
        $this->amount = $amount;
    }

    public function satisfy(Cart $cart)
    {
        return (count($cart) > $this->quantity) || ($cart->getTotalPrice()->getAmount() > $this->amount);
    }

}