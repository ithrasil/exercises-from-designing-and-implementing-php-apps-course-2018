<?php

namespace Structure;

use IStructure;
use \RuntimeException;

class Stack implements IStructure
{
    private $stack = array();

    public function __construct(array $arr=[]) {
        $this->stack = $arr;
    }

    public function push(string $element): void
    {
        $dvalue = doubleval($element);
        array_push($this->stack, $dvalue);
    }

    public function popNTimes(int $n): array
    {
        $args = array();

        for ($i = 0; $i < $n; $i++) {
            if ($this->isNotEmpty()) {
                $val = $this->pop();
                array_push($args, $val);
            }
            else {
                throw new RuntimeException("Stack is empty!");
            }
        }

        return $args;

    }

    public function getStack() : array{
        return $this->stack;
    }

    public function isNotEmpty(): bool
    {
        return count($this->stack) > 0;
    }

    public function pop(): int
    {
        return array_pop($this->stack);
    }
}