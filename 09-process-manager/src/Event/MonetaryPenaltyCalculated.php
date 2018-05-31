<?php

namespace App\Event;

use Prooph\Common\Messaging\DomainEvent;
use Prooph\Common\Messaging\PayloadTrait;

class MonetaryPenaltyCalculated extends DomainEvent
{
    use PayloadTrait;

    public function getAmount()
    {
        return $this->payload["amount"];
    }

    public function getDate()
    {
        return $this->payload["date"];
    }

    public function getProcess() {
        return $this->payload["process"];
    }

}