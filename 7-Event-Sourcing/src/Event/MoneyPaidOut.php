<?php

namespace Event;

use IEvent;
use Money\Money;

class MoneyPaidOut implements IEvent
{
    private $money;

    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }
}
