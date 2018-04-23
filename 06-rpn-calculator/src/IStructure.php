<?php


interface IStructure
{

    public function push(string $element): void;

    public function pop(): int;

    public function isNotEmpty(): bool;
}