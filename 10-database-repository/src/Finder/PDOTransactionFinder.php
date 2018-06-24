<?php

namespace Finder;

use ITransactionFinder;
use PDO;

class PDOTransactionFinder implements ITransactionFinder {
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(int $limit = 10, int $offset = 0) : array
    {

    }

}