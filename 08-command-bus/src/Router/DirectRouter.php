<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 23.04.2018
 * Time: 23:25
 */

namespace Router;

use AbstractCommand;
use IRouter;

class DirectRouter implements IRouter
{
    private $routes;

    public function __construct(array $commands)
    {
        $this->routes = $commands;
    }

    public function getHandlerClass(AbstractCommand $command)
    {
        $commandClass = get_class($command);
        if (!array_key_exists($commandClass, $this->routes)) {
            throw new NoRouteFoundException("Route not found");
        }
        return $this->routes[$commandClass];
    }
}