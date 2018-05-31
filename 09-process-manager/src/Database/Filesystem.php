<?php

namespace App\Database;

use App\IDatabase;

class Filesystem implements IDatabase
{
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function insert(string $entity, string $name, array $payload)
    {
        $file = $this->path . "$entity/$name.json";

        if (file_exists($file)) {
            throw new \RuntimeException();
        } else {
            file_put_contents($file, json_encode($payload, JSON_PRETTY_PRINT));
        }
    }

    public function update(string $entity, string $name, array $payload)
    {
        $file = $this->path . "$entity/$name.json";

        if (file_exists($file)) {
            file_put_contents($file, json_encode($payload, JSON_PRETTY_PRINT));

        } else {
            throw new \RuntimeException();
        }
    }

    public function select(string $entity, string $name)
    {
        $file = $this->path . "$entity/$name.json";

        if (file_exists($file)) {
            return json_decode(file_get_contents($file));
        } else {
            return null;
        }
    }

    public function delete(string $entity, string $name)
    {
        $file = $this->path . "$entity/$name.json";

        if (file_exists($file)) {
            return unlink($file);
        } else {
            return null;
        }
    }
}