<?php

namespace Event;

use IEvent;
use Money\Money;

class MoneyPaidIn implements IEvent
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
