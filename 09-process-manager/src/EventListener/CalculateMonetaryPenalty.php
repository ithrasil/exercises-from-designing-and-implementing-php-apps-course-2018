<?php

namespace App\EventListener;

use App\Event\MonetaryPenaltyCalculated;
use App\AbstractEventListener;
use App\Database\Filesystem;
use Prooph\Common\Messaging\DomainEvent;

class CalculateMonetaryPenalty extends AbstractEventListener
{
    /**
     * @var MonetaryPenaltyCalculated $event
     * @var Filesystem $db
     **/
    public function __invoke(DomainEvent $event)
    {
        $this->db->update(
            "process",
            $event->getProcess()->account_id,
            [
                "account_id" => $event->getProcess()->account_id,
                "date_from" => $event->getProcess()->date_from,
                "date_to" => $event->getProcess()->date_to,
                "monetary_penalty" => $event->getAmount(),
                "expected_events" => ["MonetaryPenaltyPaymentRegistered"],
            ]
        );
    }
}