<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 23.04.2018
 * Time: 23:11
 */

namespace Command;

use AbstractCommand;

class PongCommand extends AbstractCommand
{
    public function act(): void
    {
        echo "PING!" . PHP_EOL;
    }
}