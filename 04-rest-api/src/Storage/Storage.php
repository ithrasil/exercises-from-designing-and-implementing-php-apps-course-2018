<?php

namespace Storage;

use IStorage;

class Storage implements IStorage
{
    private $source;

    public function __construct(string $source)
    {
        $this->source = $source;
    }

    public function get(): array
    {
        $data = array();
        $files = array_diff(scandir($this->source), array('.', '..'));

        foreach ($files as $file) {
            array_push($data, $this->read($this->source . $file));
        }

        return $data;
    }

    private function read(string $filename): array
    {
        return json_decode(file_get_contents($filename), true);
    }

    public function getById(int $id): array
    {
        $path = $this->source . $id . ".json";
        if (file_exists($path)) {
            return $this->read($path);
        }
        return array();
    }

    public function update(array $data, int $id): void
    {
        $encoded = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($this->source . $id . ".json", $encoded);
    }

    public function delete(int $id): void
    {
        unlink($this->source . $id . ".json");
    }

    public function isData(int $id): bool
    {
        return file_exists($this->source . $id . ".json");
    }
}

