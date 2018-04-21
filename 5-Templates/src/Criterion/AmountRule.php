<?php

namespace Criterion;

use Cart\Cart;
use Criterion;

class AmountRule implements Criterion {
    private $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function satisfy(Cart $cart)
    {
        return $cart->getTotalPrice()->getAmount() > $this->amount;
    }

}