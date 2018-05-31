<?php

namespace App\Event;

use Prooph\Common\Messaging\DomainEvent;
use Prooph\Common\Messaging\PayloadTrait;

class BookDateLimitOverran extends DomainEvent
{
    use PayloadTrait;

    public function getDate()
    {
        return $this->payload["date"];
    }

    public function getProcess() {
        return $this->payload["process"];
    }
}