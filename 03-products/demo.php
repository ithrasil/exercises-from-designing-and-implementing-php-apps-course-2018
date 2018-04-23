<?php

require_once 'vendor/autoload.php';

use Money\Money;
use Bundle\Bundle;
use Product\Product;
use Discounted\Discounted;

$product1 = new Product("produkt 1", Money::PLN(10000));
$product2 = new Product("produkt 2", Money::PLN(20000));

$discounted1 = new Discounted($product1, 20);
$discounted2 = new Discounted($product2, 20);

$bundle1 = new Bundle("bundle 1", array($discounted1, $product1));
$bundle2 = new Bundle("bundle 2", array($discounted2, $product2));

$totalPrice = Money::PLN(0);

$products = [
	$discounted1,
	$discounted2,
	$product1,
	$product2,
	$bundle1,
	$bundle2
];

foreach ($products as $product) {
    echo $product->getName() . PHP_EOL;    
    $totalPrice = $totalPrice->add($product->getPrice());
}

echo 'TOTAL PRICE: ...' . $totalPrice->getAmount(); // wyświetl łączną cenę wszystkich produktów

?>