<?php

require_once(__DIR__ . "/vendor/autoload.php");

use Money\Money;
use Money\Currency;
use Wallet\Wallet;

unset($argv[0]);

$used_currency = $argv[1];

unset($argv[1]);

$wallet = new Wallet($used_currency);
$withdrawal = $money = new Money(array_pop($argv), new Currency($used_currency));

foreach($argv as $key => $arg) {
    $money = new Money($arg, new Currency($used_currency));
    $wallet->deposit($money);
}
$wallet->withdraw($withdrawal);
$w = Wallet::FromEvents($wallet->getEvents());

echo $w->getBalance()->getAmount();
