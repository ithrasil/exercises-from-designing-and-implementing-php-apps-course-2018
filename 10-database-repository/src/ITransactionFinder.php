<?php

interface ITransactionFinder
{
    public function findAll(int $limit = 10, int $offset = 0) : array;
}