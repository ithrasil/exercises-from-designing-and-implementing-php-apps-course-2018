<?php

abstract class AbstractCommand
{
    /**
     * @var \DateTime
     */
    private $created;

    public function __construct(DateTime $created = null)
    {
        $this->created = $created;
    }

}