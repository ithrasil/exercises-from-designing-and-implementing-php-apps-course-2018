<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 23.04.2018
 * Time: 23:10
 */

namespace Command;
use AbstractCommand;

class PingCommand extends AbstractCommand
{
    public function act() : void {
        echo "PONG!" . PHP_EOL;
    }
}