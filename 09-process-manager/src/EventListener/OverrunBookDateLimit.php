<?php

namespace App\EventListener;

use App\Event\BookDateLimitOverran;
use App\AbstractEventListener;
use App\Database\Filesystem;
use Prooph\Common\Messaging\DomainEvent;

class OverrunBookDateLimit extends AbstractEventListener{

    /**
     * @var BookDateLimitOverran $event
     * @var Filesystem $db
     **/
    public function __invoke(DomainEvent $event) {
        if($event->getProcess()->date_to == $event->getDate()) {
            $this->db->update(
                "process",
                $event->getProcess()->account_id,
                [
                    "account_id" => $event->getProcess()->account_id,
                    "date_from" => $event->getProcess()->date_from,
                    "date_to" => $event->getProcess()->date_to,
                    "expected_events" => ["MonetaryPenaltyCalculated"],
                ]
            );
        }
        else {
            throw new \RuntimeException();
        }
    }
}