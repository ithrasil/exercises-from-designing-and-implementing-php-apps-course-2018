<?php

namespace Explainer;

use IExplainer;
use PDO;

class PDOExplainer implements IExplainer
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function explain(string $table) : array
    {
        return $this->connection->query("EXPLAIN SELECT * FROM $table", PDO::FETCH_ASSOC)->fetch();
    }

    public function explainWhere(string $table, string $predicate) : array
    {
        return $this->connection->query("EXPLAIN SELECT * FROM $table WHERE " . $predicate, PDO::FETCH_ASSOC)->fetch();
    }

}