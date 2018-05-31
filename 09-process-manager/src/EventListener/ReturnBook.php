<?php

namespace App\EventListener ;

use App\Event\BookReturned;
use App\AbstractEventListener;
use App\Database\Filesystem;
use Prooph\Common\Messaging\DomainEvent;

class ReturnBook extends AbstractEventListener{

    /**
     * @var BookReturned $event
     * @var Filesystem $db
     **/
    public function __invoke(DomainEvent $event) {
        $this->db->delete("process", $event->getBook());
    }
}