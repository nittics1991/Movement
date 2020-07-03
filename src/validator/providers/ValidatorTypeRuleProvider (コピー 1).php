<?php

/**
*   ValidatorRuleProvider
*
*   @version 200704
**/

namespace Concerto\standard;

use Concerto\container\provider\AbstractServiceProvider;

class ValidatorRuleProvider extends AbstractServiceProvider
{
    protected $provides = [
        'isbool',
        'isInt',
    ];
    
    public function register()
    {
        $this->bind('isBool', function($container) {
            return function($value, $parameters = []) {
                return is_bool($value);
            };
        });
        
        $this->bind('isInt', function($container) {
            return function($value, $parameters = []) {
                return is_int($value);
            };
        });
        
        
        
        
        
        
        
    }
}
