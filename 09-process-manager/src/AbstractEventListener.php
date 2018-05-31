<?php

namespace App;

use Prooph\Common\Messaging\DomainEvent;

abstract class AbstractEventListener {

    protected $db;

    public function __construct(IDatabase $db=null)
    {
        $this->db = $db;
    }
    abstract public function __invoke(DomainEvent $event);
}