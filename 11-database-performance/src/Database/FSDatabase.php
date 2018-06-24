<?php

namespace Database;

use IDatabase;

class FSDatabase implements IDatabase
{
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function clear(): void
    {
        try {
            file_put_contents($this->path, '');
        } catch (\RuntimeException $e) {
            throw $e;
        }
    }

    public function write(string $string): void
    {
        try {
            file_put_contents($this->path, $string . "\n", FILE_APPEND);
        } catch (\RuntimeException $e) {
            throw $e;
        }

    }

    public function read(): string
    {
        try {
            file_get_contents($this->path);
        } catch (\RuntimeException $e) {
            throw $e;
        }
    }
}