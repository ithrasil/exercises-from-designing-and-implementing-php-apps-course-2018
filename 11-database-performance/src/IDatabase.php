<?php

interface IDatabase
{
    public function clear(): void;

    public function write(string $string): void;

    public function read(): string;
}