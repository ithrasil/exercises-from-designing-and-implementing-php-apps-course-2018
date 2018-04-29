<?php

require_once(__DIR__ . "/vendor/autoload.php");



use Command\PingCommand;
use Command\PongCommand;
use Handler\PingHandler;
use Handler\PongHandler;
use Router\DirectRouter;

$router = new DirectRouter([
    PingCommand::class => PingHandler::class,
    PongCommand::class => PongHandler::class,
]);

$commandBus = new CommandBus($router);

$commandBus->dispatch(new PingCommand());
$commandBus->dispatch(new PongCommand());