<?php

require_once(__DIR__ . "/vendor/autoload.php");

use Cart\Cart;
use Criterion\AmountRule;
use Criterion\KeywordRule;
use Criterion\QuantityAmountRule;
use Criterion\QuantityRule;
use Product\StandardProduct;

$products = createProducts(3);

$carts = createCarts(3, $products);

$criteria_array = createCriteria();

foreach ($criteria_array as $criteria) {
    foreach ($carts as $cart) {
        echo $cart->canIAddGift($criteria) . PHP_EOL;
    }
}

function createCriteria(): array
{
    $criteria = array();

    array_push($criteria, array(new AmountRule(50), new KeywordRule()));
    array_push($criteria, array(new QuantityAmountRule(20, 500)));
    array_push($criteria, array(new QuantityRule(1), new KeywordRule()));


    $rules = new Not(new AndRule([
       new OrRule([
           new AndRule([
               new AmountRule(),
               new QuantityRule()
           ])
       ])
    ]));

    return $criteria;
}

function createCarts(int $max, array $products): array
{
    $carts = array();

    for ($i = 0; $i < $max; $i++) {
        $cart = new Cart();

        for ($j = 0; $j < rand(0, 5); $j++) {
            $product = $products[array_rand($products)];
            $cart->addProduct($product);
        }

        array_push($carts, $cart);
    }

    return $carts;
}

function createProducts(int $max): array
{
    $products = array();

    for ($i = 0; $i < $max; $i++) {
        $product = new StandardProduct("NAME", ($max - $i) * 100);
        array_push($products, $product);
    }

    return $products;
}