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
    {
        $this->rules = [
            'isBool' => 'is_bool',
            'isInt' => 'is_int',
            
            
            
        ];
    }
}
