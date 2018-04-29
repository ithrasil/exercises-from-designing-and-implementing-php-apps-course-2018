<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 23.04.2018
 * Time: 23:23
 */

namespace Handler;
use Command\PingCommand;
use IHandler;

class PingHandler implements IHandler
{
    public function __invoke(PingCommand $command)
    {
        $command->act();
    }
}