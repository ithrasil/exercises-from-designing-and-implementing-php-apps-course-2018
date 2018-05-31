<?php

namespace App\Event;

use Prooph\Common\Messaging\DomainEvent;
use Prooph\Common\Messaging\PayloadTrait;

class BookRentalSettled extends DomainEvent {
    use PayloadTrait;

    public function finishFlow() {
        echo "PROCESS COMPLETED!";
    }

}