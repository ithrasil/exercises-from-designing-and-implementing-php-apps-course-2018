<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MaciejSz\NbpPhp\NbpRepository;
use Cache\Adapter\Redis\RedisCachePool;

$app = new Silex\Application();

//$client = new \Redis();
//$client->connect('192.168.99.100:32769', 6379);
//$pool = new RedisCachePool($client);

$nbp = new NbpRepository();

$app->get('/nbp', function(Request $req) use($app, $nbp) {
    $req_currency = $req->get('currency');
    $req_date = $req->get('date');

    $currencyData = $nbp->getRate($req_date, $req_currency);
    return new Response($currencyData->avg);
});

$app->run();