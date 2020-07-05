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
                list($date, $target) = $this->toDateTime($f, $v, $t);
                
                if (!$date || !$target) {
                    return false;
                }
                return $date == $target;
            },
            
            
            
            
        ];
   }
   
    /**
    *   toDateTime
    *
    *   @param string $format
    *   @param string $value1
    *   @param string $value2
    *   @return DateTime|bool[]
    */
    protected function toDateTime(
        string $format,
        string $value1,
        string $value2
    ): array {
        $date1 = date_create_from_format("!{$format}", $value1);
        $date2 = date_create_from_format("!{$format}", $value2);
        return [$date1, $date2];
    }
}
