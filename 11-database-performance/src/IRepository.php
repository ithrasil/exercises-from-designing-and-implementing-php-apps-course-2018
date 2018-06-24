<?php

interface IRepository
{
    public function save(Transaction $transaction): void;
    public function get(string $id) : Transaction;
}