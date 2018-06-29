<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Cache\Adapter\Predis\PredisCachePool;
use MaciejSz\NbpPhp\NbpRepository;
use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

$client = new \Predis\Client('tcp://192.168.99.100:32769');
$pool = new PredisCachePool($client);

$app->get('/nbp', function (Request $req) use ($app, $pool) {
    $nbp = new NbpRepository();

    $req_currency = $req->get('currency');
    $req_date = $req->get('date');

    $key = "$req_currency . $req_date";

    if ($pool->hasItem($key)) {
        return $pool->getItem($key)->get();
    }

    $avg_rate = $nbp->getRate($req_date, $req_currency)->avg;

    $item = $pool->getItem($key);
    $item->set($avg_rate);
    $item->expiresAfter(60);
    $pool->save($item);

    return $avg_rate;
});

$app->run();