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
            'dateFormat' => function($v, $f) {
                if (!($date = date_create_from_format("!{$f}", $v))) {
                    return false;
                }
                if (!($formatted = date_format($date, $f))) {
                    return false;
                }
                return $formatted == $v;
            },
            'dateEqual' => function($v, $f, $t) {
                if (!($date = date_create_from_format("!{$f}", $v))) {
                    return false;
                }
                if (!($target = date_create_from_format("!{$f}", $t))) {
                    return false;
                }
                return $date == $target;
            },
            
            
            
            
        ];
   }
}
