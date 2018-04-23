<?php

use Cart\Cart;

// Specification pattern
class AndRule implements Criterion {
    private $rules = array();

    /**
     * AndRule constructor.
     * @param array $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function satisfy(Cart $cart) {
        /**
         * @var $rule Criterion
         */
        foreach($this->rules as $rule) {
            if(!$rule->satisfy($cart)) {
                return false;
            }
        }

        return true;
     // TODO: Implement satisfy() method.
    }
}