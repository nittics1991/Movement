<?php

/**
*   ValidatorMathRuleProvider
*
*   @version 200704
**/

namespace Movement\validator\providers;

use Movement\validator\AbstractValidatorRuleProvider;

class ValidatorMathRuleProvider extends AbstractValidatorRuleProvider
{
    /**
    *   {inherit}
    *
    */
    protected function setRules()
    {
        $this->rules = [
            'isNan' => fn($v) => is_nan($v),
            'isNotNan' => fn($v) => !is_nan($v),
            'isFinite' => fn($v) => is_finite($v),
            'isInfinite' => fn($v) => is_infinite($v),
            'positive' => fn($v) => $v > 0,
            'positiveOrZero' => fn($v) => $v >= 0,
            'negative' => fn($v) => $v < 0,
            'negativeOrZero' => fn($v) => $v <= 0,
            'between' => function($v, $min, $max) {
                 return !is_nan($v) && $v >= $min && $v <= $max;
             },
            'overlap' => function($v, $min, $max) {
                 return !is_nan($v) && $v >= $min && $v < $max;
             },
            'inner' => function($v, $min, $max) {
                 return !is_nan($v) && $v > $min && $v < $max;
             },
            'outer' => function($v, $min, $max) {
                 return !is_nan($v) && $v < $min || $v > $max;
             },
            'min' => fn($v, $p) => $v >= $p,
            'max' => fn($v, $p) => $v <= $p,
        ];
   }
}
