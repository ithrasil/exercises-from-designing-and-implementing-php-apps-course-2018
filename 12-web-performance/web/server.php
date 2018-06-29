<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MaciejSz\NbpPhp\NbpRepository;
use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

$app->get('/nbp', function (Request $req) use ($app) {
    $nbp = new NbpRepository();
    $req_currency = $req->get('currency');
    $req_date = $req->get('date');
    $avg_rate = $nbp->getRate($req_date, $req_currency)->avg;
    return $avg_rate;
});

$app->run();