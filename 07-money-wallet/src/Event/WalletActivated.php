<?php

namespace Event;

use IEvent;

class WalletActivated implements IEvent
{
    private $status = true;
    private $reason;

    public function __construct(string $reason)
    {
        $this->reason = $reason;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getReason(): string
    {
        return $this->status;
    }
}