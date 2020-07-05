<?php

/**
*   ValidatorDateRuleProvider
*
*   @version 200704
**/

namespace Movement\validator\providers;

use Movement\validator\AbstractValidatorRuleProvider;
use DateTime;

class ValidatorDateRuleProvider extends AbstractValidatorRuleProvider
{
    /**
    *   {inherit}
    *
    */
    protected function setRules()
    {
        $this->rules = [
            'dateFormat' => function($v, $p) {
                if (!($date = date_create_from_format("!{$p}", $v))) {
                    return false;
                }
                if (!($formatted = date_format($date, $p))) {
                    return false;
                }
                return $formatted == $v;
            },
            
            
            
            
            
        ];
   }
}
