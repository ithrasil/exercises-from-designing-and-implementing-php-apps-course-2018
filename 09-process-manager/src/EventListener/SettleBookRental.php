<?php

namespace App\EventListener;

use App\Event\BookRentalSettled;
use App\AbstractEventListener;
use App\Database\Filesystem;
use Prooph\Common\Messaging\DomainEvent;

class SettleBookRental extends AbstractEventListener
{
    /**
     * @var BookRentalSettled $event
     * @var Filesystem $db
     **/
    public function __invoke(DomainEvent $event)
    {
        $event->finishFlow();
    }
}