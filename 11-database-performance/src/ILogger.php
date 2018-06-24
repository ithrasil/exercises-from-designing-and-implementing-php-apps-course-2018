<?php

interface ILogger
{
    public function clear(): void;

    public function log(string $table): void;

    public function logWhere(string $table, string $predicate): void;
}