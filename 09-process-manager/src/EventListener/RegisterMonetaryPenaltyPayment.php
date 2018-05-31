<?php

namespace App\EventListener;

use App\Event\MonetaryPenaltyPaymentRegistered;
use App\AbstractEventListener;
use App\Database\Filesystem;
use Prooph\Common\Messaging\DomainEvent;

class RegisterMonetaryPenaltyPayment extends AbstractEventListener {

    /**
     * @var MonetaryPenaltyPaymentRegistered $event
     * @var Filesystem $db
     **/
    public function __invoke(DomainEvent $event) {
        if($event->getProcess()->monetary_penalty == $event->getAmount()) {
            $this->db->update(
                "process",
                $event->getProcess()->account_id,
                [
                    "account_id" => $event->getProcess()->account_id,
                    "date_from" => $event->getProcess()->date_from,
                    "date_to" => $event->getProcess()->date_to,
                    "expected_events" => ["BookReturned"],
                ]
            );
        } else {
            throw new \RuntimeException();
        }
    }
}