<?php

use Cart\Cart;

interface Criterion
{
    /**
     * @param Cart $cart
     * @return mixed
     */
    public function satisfy(Cart $cart); // bool
}