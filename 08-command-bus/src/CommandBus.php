<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 23.04.2018
 * Time: 23:24
 */

use Exceptions\NoRouteFoundException;

class CommandBus
{
    private $router;
    public function __construct(IRouter $router)
    {
        $this->router = $router;
    }

    /**
     * @param AbstractCommand $command
     */
    public function dispatch(AbstractCommand $command)
    {
        $handlerClass = $this->router->getHandlerClass($command);
        $handler = new $handlerClass;
        $handler($command);
    }
}