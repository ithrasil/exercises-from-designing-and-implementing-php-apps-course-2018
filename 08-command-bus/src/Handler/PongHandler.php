<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 23.04.2018
 * Time: 23:24
 */

namespace Handler;
use Command\PongCommand;
use IHandler;

class PongHandler implements IHandler
{
    public function __invoke(PongCommand $command)
    {
        $command->act();
    }
}