<?php

require_once __DIR__ . './vendor/autoload.php';

use Repository\PDORepository;

$pdo = new PDO('mysql:host=localhost;dbname=lista11', 'root', '');

$repository = new PDORepository($pdo);

$loader = new Nelmio\Alice\Loader\NativeLoader();

$objectSet = $loader->loadData([
    Transaction::class => [
        "transaction{1..$argv[1]}" => [
            'id' => '<numberBetween(10000, 100000000)>',
            'outlet_id' => '<numberBetween(10000, 100000000)>',
            'created' => '<dateTimeBetween("-1 years", "now")>',
            'amount' => '<numberBetween(100, 2500)>',
            'title' => '<word()>'
        ]
    ]
]);

$transactionSet = array();

foreach ($objectSet->getObjects() as $transaction) {
    /**
     * @var $transaction Transaction
     */
    $transactionSet[] = $transaction->print();
}

$fields = array('id', 'outlet_id', 'created', 'amount', 'title');

$repository->saveMultiple('transactions_partitioned', $transactionSet, $fields);




