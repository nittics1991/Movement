<?php

/**
*   ValidatorRuleProvider
*
*   @version 200704
**/

namespace Concerto\standard;

use Concerto\container\provider\AbstractServiceProvider;

class ValidatorDateTimeRuleProvider extends AbstractServiceProvider
{
    protected $provides = [
        'isDateTimeObject',
        'isYYYYMM',
    ];
    
    public function register()
    {
        $this->bind('isYYYYMM', function ($container) {
            return function ($value, $parameters = []) {
            };
        });
        
        $this->bind('isYYYYMM', function ($container) {
            return function ($value, $parameters = []) {
                return is_string($value)
                    && mb_ereg_match('\A20[0-9]{2}[0-1][0-9]\z', $value)
                    && checkdate(
                        mb_substr($value, 4, 2),
                        mb_substr($value, 6, 2),
                        mb_substr($value, 0, 4)
                    );
            };
        });
    }
}
