<?php

require_once(__DIR__ . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
use Money\Money;
use Money\Currency;
use Repository\PDOTransactionRepository;
use Finder\PDOTransactionFinder;

//TODO: Fix issues with LIMIT and OFFSET in db queries

$dbh = new PDO('mysql:host=localhost;dbname=lista10', "root", "");

$repository = new PDOTransactionRepository($dbh);
$finder = new PDOTransactionFinder($dbh);

$transaction = new Transaction(
    Uuid::uuid4()->toString(),
    new Money(50, new Currency("PLN")),
    "A",
    "B",
    "ACTIVE"
);

$selected_data = $finder->findAll();
//echo var_export($repository->get("632336f7-8a11-4773-beca-ba9b73d50d32"));

echo var_export($selected_data );



