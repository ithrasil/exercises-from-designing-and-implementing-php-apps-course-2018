<?php

namespace Criterion;

use Cart\Cart;
use Criterion;

class KeywordRule implements Criterion
{
    private $keyword;

    public function __construct(string $keyword="TELEWIZOR")
    {
        $this->$keyword = $keyword;
    }

    public function satisfy(Cart $cart)
    {
        $products = $cart->getProducts();
        foreach ($products as $product) {
            if (strpos($product->getName(), $this->keyword) !== false) {
                return true;
            }
        }
        return false;
    }

}