<?php

interface IRepository
{
    public function save(Transaction $transaction): void;
    public function saveMultiple(string $table, array $transactions, array $fields) : void;
    public function get(string $id) : Transaction;
}