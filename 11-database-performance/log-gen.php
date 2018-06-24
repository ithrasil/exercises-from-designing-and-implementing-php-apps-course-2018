<?php

require_once __DIR__ . './vendor/autoload.php';

use Logger\FSLogger;
use Explainer\PDOExplainer;
use Database\FSDatabase;

$pdo = new PDO('mysql:host=localhost;dbname=lista11', 'root', '');
$fsdb = new FSDatabase(__DIR__ . './storage/log.txt');
$finder = new PDOExplainer($pdo);

$logger = new FSLogger($fsdb, $finder);

$logger->clear();
$logger->log('transactions_partitioned');
$logger->logWhere('transactions_partitioned', 'created >= "2018-04-22 00:00:00"');
$logger->logWhere('transactions_partitioned', 'created >= "2018-02-22 00:00:00"');
$logger->logWhere('transactions_partitioned', 'created >= "2017-12-22 00:00:00"');
$logger->logWhere('transactions_partitioned', 'created >= "2017-10-22 00:00:00"');
$logger->logWhere('transactions_partitioned', 'created >= "2017-08-22 00:00:00"');
$logger->logWhere('transactions_partitioned', 'created >= "2017-06 -22 00:00:00"');