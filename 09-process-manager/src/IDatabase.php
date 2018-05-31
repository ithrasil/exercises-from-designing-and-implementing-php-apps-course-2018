<?php

namespace App;

interface IDatabase {
    public function insert(string $entity, string $name, array $payload);
    public function update(string $entity, string $name, array $payload);
    public function select(string $entity, string $name);
    public function delete(string $entity, string $name);
}