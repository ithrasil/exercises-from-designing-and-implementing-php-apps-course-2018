<?php

namespace Calculator;

use ICalculator;
use Structure\Stack;

class RPNCalculator implements ICalculator
{
    private $operators = ["+", "-", "*", "/"],
        $functions = ["sin" => 1, "cos" => 1, "log" => 2],
        $stack;

    public function __construct()
    {
        $this->stack = new Stack();
    }

    public function compute(string $expression): string
    {

        $arr_expression = explode(" ", $expression);

        foreach ($arr_expression as $symbol) {

            if (is_numeric($symbol)) {
                $this->stack->push($symbol);
            } else if (in_array($symbol, $this->operators)) {
                $args = $this->stack->popNTimes(2);

                $result = 0;

                switch ($symbol) {
                    case "+":
                        $result = $args[1] + $args[0];
                        break;

                    case "-":
                        $result = $args[1] - $args[0];
                        break;

                    case "*":
                        $result = $args[1] * $args[0];
                        break;

                    case "/":
                        $result = $args[1] / $args[0];
                        break;
                }

                $this->stack->push($result);

            } else if (array_key_exists($symbol, $this->functions)) {

                $args = $this->stack->popNTimes($this->functions[$symbol]);

                $result = 0;

                switch ($symbol) {
                    case "sin":
                        $result = sin($args[0]);
                        break;
                    case "cos":
                        $result = cos($args[0]);
                        break;
                    case "log":
                        $result = log($args[0], $args[1]);
                        break;
                }

                $this->stack->push($result);
            }
        }

        return $this->stack->pop();
    }
}