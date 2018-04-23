<?php

require_once __DIR__ . "/vendor/autoload.php";

use Calculator\RPNCalculator;

$calculator = new RPNCalculator();

echo $calculator->compute("2 3 + 5 * 10 +") . PHP_EOL;
echo $calculator->compute("5 sin 20 + 3 *") . PHP_EOL;
echo $calculator->compute("2 2 + 2 * 4 / 10 * 400 log") . PHP_EOL;