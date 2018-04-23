<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Money;
use Product\Product;
use Storage\Storage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$storage = new Storage(__DIR__ . "/../Storage/");
$faker = Faker\Factory::create();
$currencies = new ISOCurrencies();

$app->get('/products', function () use ($app, $storage) : string {
    return $app->json($storage->get());
});

$app->get('/products/{id}', function ($id) use ($app, $storage) {
    return $app->json($storage->getById($id));
});

$app->post('/products', function (Request $request) use ($app, $storage, $faker, $currencies) {
    $rName = $request->get("name");
    $rAmount = $request->get("amount");
    $rCurrency = $request->get("currency");

    $pid = random_int(10000000, 2000000000);
    $pName = null !== $rName ? $rName : $faker->company;

    $currency = null;
    if ($rCurrency !== null && $currencies->contains(new Currency($rCurrency))) {
        $currency = $rCurrency;
    } else {
        $currency = "PLN";
    }
    $amount = null !== $rAmount ? $rAmount : rand(15, 1125);
    $pMoney = new Money($amount, new Currency($currency));

    $product = new Product($pid, $pName, $pMoney);
    $storage->update($product->print(), $pid);

    return "Element created";
});

$app->put('/products/{id}', function ($id, Request $request) use ($app, $storage, $currencies) {
    $rName = $request->get("name");
    $rAmount = $request->get("amount");
    $rCurrency = $request->get("currency");

    if ($rName == null && $rAmount == null && ($rCurrency == null || !$currencies->contains(new Currency($rCurrency)))) {
        return new Response('No parameters', 204, array('X-Status-Code' => 200));
    }

    if ($storage->isData($id)) {
        $product = $storage->getById($id);

        $pName = null !== $rName ? $rName : $product["name"];

        $currency = null;
        if ($rCurrency !== null && $currencies->contains(new Currency($rCurrency))) {
            $currency = $rCurrency;
        } else {
            $currency = $product["money"]["currency"];
        }
        $amount = null !== $rAmount ? $rAmount : $product["money"]["amount"];
        $pMoney = new Money($amount, new Currency($currency));

        $product = new Product($id, $pName, $pMoney);

        $storage->update($product->print(), $id);
        return "Element updated";
    } else {
        return new Response('No Content', 404, array('X-Status-Code' => 200));
    }

});

$app->delete('/products/{id}', function ($id) use ($app, $storage) {

    if ($storage->isData($id)) {
        $storage->delete($id);
    } else {
        return new Response('No Content', 404, array('X-Status-Code' => 404));
    }
    return new Response('No Content', 204, array('X-Status-Code' => 200));
});

$app->run();