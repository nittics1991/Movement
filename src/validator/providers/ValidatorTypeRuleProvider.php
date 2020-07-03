<?php

/**
*   ValidatorTypeRuleProvider
*
*   @version 200704
**/

namespace Movement\validator\providers;

use Movement\validator\AbstractValidatorRuleProvider;

class ValidatorTypeRuleProvider extends AbstractValidatorRuleProvider
{
    /**
    *   {inherit}
    *
    */
    protected function setRules()
        $this->rules = [
            'isbool' => fn($v, $p) => is_bool($v),
            'isInt' => fn($v, $p) => is_int($v),
            
            
            
        ];
    }
}
