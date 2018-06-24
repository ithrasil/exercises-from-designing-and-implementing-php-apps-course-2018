<?php

namespace App;

use App\Event\BookBorrowed;
use App\Event\BookDateLimitOverran;
use App\Event\BookRentalSettled;
use App\Event\BookReturned;
use App\Event\MonetaryPenaltyCalculated;
use App\Event\MonetaryPenaltyPaymentRegistered;
use Prooph\ServiceBus\EventBus;

class Process
{
    private $event_bus;
    private $events = [
        "BookDateLimitOverran" => "overrunDateLimit",
        "MonetaryPenaltyCalculated" => "penaltyCalculated",
        "MonetaryPenaltyPaymentRegistered" => "penaltyPaymentRegistered",
        "BookReturned" => "returnBook",
    ];

    public function __construct(EventBus $event_bus)
    {
        $this->event_bus = $event_bus;
    }

    public function act($saved_process, $event_name, $argv)
    {
        $process_complete = false;
        if ($saved_process == null) {

            if ($event_name == "BookBorrowed") {
                $this->borrowBook($argv);
            }
        } else if ($event_name != "BookBorrowed" && $saved_process->account_id == $argv[1]) {

            if (array_key_exists($event_name, $this->events)) {
                if (in_array($event_name, $saved_process->expected_events)) {
                    $fn = $this->events[$event_name];
                    $this->$fn($argv, $saved_process);

                    if($event_name == "BookReturned") {
                        $process_complete = true;
                    }
                }
            }
            else {
                throw new \RuntimeException();
            }

        } else {
            throw new \RuntimeException();
        }

        if ($process_complete) {
            $this->settleRental();
        }
    }

    private function borrowBook($argv)
    {
        $this->event_bus->dispatch(
            new BookBorrowed(
                array(
                    "book_instance_id" => $argv[0],
                    "account_id" => $argv[1],
                    "date_from" => $argv[2],
                    "date_to" => $argv[3]
                )
            )
        );
    }

    private function settleRental()
    {
        $this->event_bus->dispatch(new BookRentalSettled());
    }

    private function overrunDateLimit($argv, $saved_process)
    {
        $this->event_bus->dispatch(
            new BookDateLimitOverran(
                array(
                    "date" => $argv[2],
                    "process" => $saved_process
                )
            )
        );
    }

    private function penaltyCalculated($argv, $saved_process)
    {
        $this->event_bus->dispatch(
            new MonetaryPenaltyCalculated(
                array(
                    "amount" => $argv[2],
                    "date" => $argv[3],
                    "process" => $saved_process
                )
            )
        );
    }

    private function penaltyPaymentRegistered($argv, $saved_process)
    {
        $this->event_bus->dispatch(
            new MonetaryPenaltyPaymentRegistered(
                array(
                    "amount" => $argv[2],
                    "date" => $argv[3],
                    "process" => $saved_process
                )
            )
        );
    }

    private function returnBook($argv, $saved_process)
    {
        $this->event_bus->dispatch(
            new BookReturned(
                array(
                    "book_instance_id" => $argv[0],
                )
            )
        );
    }
}
