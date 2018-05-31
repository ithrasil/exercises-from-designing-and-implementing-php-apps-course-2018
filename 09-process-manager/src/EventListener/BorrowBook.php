<?php

namespace App\EventListener;

use App\Event\BookBorrowed;
use App\AbstractEventListener;
use App\Database\Filesystem;
use Prooph\Common\Messaging\DomainEvent;

class BorrowBook extends AbstractEventListener{

    /**
     * @var BookBorrowed $event
     * @var Filesystem $db
     **/
    public function __invoke(DomainEvent $event)
    {
        $this->db->insert(
            "process",
            $event->getBook(),
            [
                "account_id" => $event->getAccount(),
                "date_from" => $event->getDate(),
                "date_to" => $event->getDateTo(),
                "expected_events" => ["BookReturned", "BookDateLimitOverran"],
            ]
        );
    }

}