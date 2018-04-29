<?php

interface IRouter {
    public function getHandlerClass(AbstractCommand $command);
}