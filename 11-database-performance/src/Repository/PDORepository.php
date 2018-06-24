<?php

namespace Repository;

use IRepository;
use PDO;
use \PDOException;
use Transaction;

class PDORepository implements IRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function get(string $id): Transaction
    {
        // TODO: to implement
    }

    public function saveMultiple(string $table, array $transactions, array $fields): void
    {
        $this->pdo->beginTransaction();
        $insert_values = array();
        $question_marks = array();

        foreach ($transactions as $transaction) {
            $question_marks[] = '(' . $this->placeholders('?', \count($transaction)) . ')';
            $insert_values = array_merge($insert_values, array_values($transaction));
        }

        $sql = 'INSERT INTO' . $table . '  (' . implode(',', $fields) . ') VALUES '.
            implode(',', $question_marks);

        $statement = $this->pdo->prepare($sql);

        try {
            $statement->execute($insert_values);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->pdo->commit();
    }

    public function save(Transaction $transaction): void
    {
        // TODO: to implement
    }

    private function placeholders(string $text, int $count = 0, string $separator = ','): string
    {
        $result = array();
        for ($x = 0; $x < $count; $x++) {
            $result[] = $text;
        }

        return implode($separator, $result);
    }


}