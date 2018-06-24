<?php

require_once __DIR__ . "./vendor/autoload.php";

use Prooph\ServiceBus\EventBus;
use Prooph\ServiceBus\Plugin\Router\EventRouter;

use Config\RouterConfig;

use App\Database\Filesystem;

use App\Process;

$db = new Filesystem(__DIR__ . "/storage/");

$router_config = new RouterConfig($db);

/* @var EventRouter $event_router */
$event_router = $router_config->getRouter();

$event_bus = new EventBus();

$event_router->attachToMessageBus($event_bus);

$argv = array_values($argv);

unset($argv[0]);

$event_name = $argv[1];

unset($argv[1]);

$argv = array_values($argv);
$saved_process = $db->select("process", $argv[0]);


$process = new Process($event_bus);
$process->act($saved_process, $event_name, $argv);

