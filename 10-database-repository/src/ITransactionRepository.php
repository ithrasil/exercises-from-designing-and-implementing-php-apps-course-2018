<?php

use Ramsey\Uuid\Uuid;

interface ITransactionRepository
{
    public function get(string $transactionId): Transaction;

    public function save(Transaction $transaction): void;
}