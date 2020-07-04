<?php

/**
*   ValidatorBcCompareRuleProvider
*
*   @version 200704
**/

namespace Movement\validator\providers;

use Movement\validator\AbstractValidatorRuleProvider;

class ValidatorBcCompareRuleProvider extends AbstractValidatorRuleProvider
{
    /**
    *   {inherit}
    *
    */
    protected function setRules()
    {
        $this->rules = [
            'equalStrict' => fn($v, $p, $s = 0) => bccomp($v, $p, $s) == 0,
            'notEqualStrict' => fn($v, $p, $s = 0) => bccomp($v, $p, $s) != 0,
            'greaterStrict' => fn($v, $p, $s = 0) => bccomp($v, $p, $s) == 1,
            'greaterThanStrict' => function($v, $p, $s = 0) {
                return bccomp($v, $p, $s) == 1
                    || bccomp($v, $p, $s) == 0;
            },
            'lessStrict' => fn($v, $p, $s = 0) => bccomp($v, $p, $s) == -1,
            'lessThanStrict' => function($v, $p, $s = 0) {
                return bccomp($v, $p, $s) == -1
                    || bccomp($v, $p, $s) == 0;
            },
        ];
   }
}
