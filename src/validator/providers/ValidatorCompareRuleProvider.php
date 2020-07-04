<?php

/**
*   ValidatorCompareRuleProvider
*
*   @version 200704
**/

namespace Movement\validator\providers;

use Movement\validator\AbstractValidatorRuleProvider;

class ValidatorCompareRuleProvider extends AbstractValidatorRuleProvider
{
    /**
    *   {inherit}
    *
    */
    protected function setRules()
    {
        $this->rules = [
            'same' => fn($v, $p) => $v === $p,
            'notSame' => fn($v, $p) => $v !== $p,
            'equal' => fn($v, $p) => $v == $p,
            'notEqual' => fn($v, $p) => $v != $p,
            'greater' => fn($v, $p) => $v > $p,
            'greaterThan' => fn($v, $p) => $v >= $p,
            'less' => fn($v, $p) => $v < $p,
            'lessThan' => fn($v, $p) => $v <= $p,
        ];
   }
}
