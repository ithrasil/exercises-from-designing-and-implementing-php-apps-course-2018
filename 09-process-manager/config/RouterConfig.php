<?php

namespace Config;

use App\Event\BookRentalSettled;
use App\EventListener\SettleBookRental;
use Prooph\ServiceBus\Plugin\Router\EventRouter;

use App\Database\Filesystem;

use App\EventListener\BorrowBook;
use App\EventListener\CalculateMonetaryPenalty;
use App\EventListener\OverrunBookDateLimit;
use App\EventListener\RegisterMonetaryPenaltyPayment;
use App\EventListener\ReturnBook;

use App\Event\BookBorrowed;
use App\Event\BookDateLimitOverran;
use App\Event\BookReturned;
use App\Event\MonetaryPenaltyCalculated;
use App\Event\MonetaryPenaltyPaymentRegistered;

class RouterConfig
{
    private $router;

    public function __construct(Filesystem $db)
    {
        $this->router = new EventRouter();
        $this->applyRoutes($db);
    }

    public function getRouter() : EventRouter{
        return $this->router;
    }

    private function applyRoutes(Filesystem $db)
    {
        // Here add routes

        $this->router->route(BookBorrowed::class)
            ->to(new BorrowBook($db));

        $this->router->route(BookDateLimitOverran::class)
            ->to(new OverrunBookDateLimit($db));

        $this->router->route(MonetaryPenaltyCalculated::class)
            ->to(new CalculateMonetaryPenalty($db));

        $this->router->route(MonetaryPenaltyPaymentRegistered::class)
            ->to(new RegisterMonetaryPenaltyPayment($db));

        $this->router->route(BookReturned::class)
            ->to(new ReturnBook($db));

        $this->router->route(BookRentalSettled::class)
            ->to(new SettleBookRental());
    }
}

