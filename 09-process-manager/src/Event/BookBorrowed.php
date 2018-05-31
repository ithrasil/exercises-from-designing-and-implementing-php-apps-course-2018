<?php

namespace App\Event;

use Prooph\Common\Messaging\DomainEvent;
use Prooph\Common\Messaging\PayloadTrait;

class BookBorrowed extends DomainEvent
{
    use PayloadTrait;

    public function getBook()
    {
        return $this->payload["book_instance_id"];
    }

    public function getAccount()
    {
        return $this->payload["account_id"];
    }

    public function getDate()
    {
        return $this->payload["date_from"];
    }

    public function getDateTo()
    {
        return $this->payload["date_to"];
    }
}