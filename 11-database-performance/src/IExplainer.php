<?php

interface IExplainer
{
    public function explain(string $table): array;

    public function explainWhere(string $table, string $predicate): array;
}