<?php

namespace Logger;

use Database\FSDatabase;
use Explainer\PDOExplainer;
use IExplainer;
use IDatabase;
use ILogger;

class FSLogger implements ILogger
{
    /**
     * @var FSDatabase $storage
     */
    private $storage;

    /**
     * @var PDOExplainer $explainer
     */
    private $explainer;

    public function __construct(IDatabase $storage, IExplainer $explainer)
    {
        $this->storage = $storage;
        $this->explainer = $explainer;
    }

    public function clear(): void {
        $this->storage->clear();
    }

    public function log(string $table): void
    {
        $fromdb = $this->explainer->explain($table);
        $toWrite = array(
            'table' => $table,
            'rows' => $fromdb['rows']
        );
        $this->storage->write(json_encode($toWrite, JSON_PRETTY_PRINT));
    }

    public function logWhere(string $table, string $predicate): void
    {
        $fromdb = $this->explainer->explainWhere($table, $predicate);
        $toWrite = array(
            'table' => $table,
            'rows' => $fromdb['rows'],
            'predicate' => $predicate
        );
        $this->storage->write(json_encode($toWrite, JSON_PRETTY_PRINT));
    }

}