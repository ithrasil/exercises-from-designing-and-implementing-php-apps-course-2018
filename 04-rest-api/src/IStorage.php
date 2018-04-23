<?php

interface IStorage
{
    public function get(): array;

    public function getById(int $id): array;

    public function update(array $data, int $id): void;

    public function delete(int $id): void;

    public function isData(int $id) : bool;
}