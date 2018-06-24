<?php

use Money\Money;

class Transaction
{
    /**
     * @var string
     **/
    private $uuid;

    /**
     * @var Money
     **/
    private $amount;

    /**
     * @var string
     */
    private $fromAccount;

    /**
     * @var string
     */
    private $toAccount;

    /**
     * @var string
     */
    private $status;

    public function __construct(string $uuid, Money $amount, string $fromAccount, string $toAccount, string $status)
    {
        $this->uuid = $uuid;
        $this->amount = $amount;
        $this->fromAccount = $fromAccount;
        $this->toAccount = $toAccount;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getFromAccount(): string
    {
        return $this->fromAccount;
    }

    /**
     * @return string
     */
    public function getToAccount(): string
    {
        return $this->toAccount;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}