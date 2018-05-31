<?php

namespace App\Event;

use Prooph\Common\Messaging\DomainEvent;
use Prooph\Common\Messaging\PayloadTrait;

class BookReturned extends DomainEvent
{
    use PayloadTrait;

    public function getBook() {
        return $this->payload["book_instance_id"];
    }

}