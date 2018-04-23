<?php

namespace Wallet;

use Event\MoneyPaidIn;
use Event\MoneyPaidOut;
use Event\WalletActivated;
use Event\WalletDeactivated;
use Ievent;
use Money\Currency;
use Money\Money;
use RuntimeException;

class Wallet
{
    private $balance;
    private $isActive = true;
    private $events = [];

    public function __construct(string $currency)
    {
        $this->balance = new Money(0, new Currency($currency));
    }

    public static function fromEvents(array $events): Wallet
    {
        if (count($events) == 0) {
            throw new RuntimeException("There is no events!");
        }

        $isCurrencySet = false;

        $wallet=null;

        foreach ($events as $event) {
        if($isCurrencySet && (get_class($event) == MoneyPaidIn::class || get_class($event) == MoneyPaidOut::class)) {
            $wallet = new Wallet($event->getMoney()->getCurrency());
        }
        $wallet->record($event);
    }
        return $wallet;
    }

    public function deposit(Money $moneyToDeposit): void
    {
        if ($moneyToDeposit->isNegative()) {
            throw new RuntimeException("Can't pay in negative amount.");
        } else if ($this->isActive == false) {
            throw new RuntimeException("Wallet is unactive");
        } else {
            $event = new MoneyPaidIn($moneyToDeposit);

            $this->record($event);
        }
    }

    public function withdraw(Money $moneyToWithdraw): void
    {
        if ($moneyToWithdraw->isNegative()) {
            throw new RuntimeException("Can't payout negative amount.");
        } else if ($this->balance->subtract($moneyToWithdraw)->isNegative()) {
            throw new RuntimeException('There is not enough funds for this payout.');
        } else if ($this->isActive == false) {
            throw new RuntimeException("Wallet is unactive");
        }

        if (!$this->canWithdrawn($moneyToWithdraw)) {
            throw new LogicException("Cant do that");
        }

        $this->record(new MoneyPaidOut($moneyToWithdraw));
    }

    public function deactivate(string $reason): void
    {
        $event = new WalletDeactivated($reason);

        $this->record($event);
    }

    public function activate(string $reason): void
    {
        $event = new WalletActivated($reason);

        $this->record($event);
    }

    public function getBalance(): Money
    {
        return $this->balance;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    private function record(IEvent $event): void
    {
        array_push($this->events, $event);
        $this->apply($event);
    }

    private function apply(IEvent $event): void
    {
        switch (get_class($event)) {
            case MoneyPaidIn::class:
                $this->balance = $this->balance->add($event->getMoney());
                break;
            case MoneyPaidOut::class:
                $this->balance = $this->balance->subtract($event->getMoney());
                break;
            case WalletDeactivated::class:
                $this->isActive = $event->getStatus();
                break;
            case WalletActivated::class:
                $this->isActive = $event->getStatus();
                break;
        }
    }

}