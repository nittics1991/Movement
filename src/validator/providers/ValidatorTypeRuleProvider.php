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
    *   methods
    *
    *   @var string[]
    */
    private $methods = [
        'isArray',
        'isBool',
        'isCallable',
        'isCountable',
        'isFloat',
        'isInt',
        'isIterable',
        'isNull',
        'isNumeric',
        'isObject',
        'isResource',
        'isScalar',
        'isString',
    ];
    
    /**
    *   {inherit}
    *
    */
    protected function setRules()
    {
        foreach ($this->methods as $method) {
            $this->rules[$method] = $this->toSnake($method);
        }
    }
    
    /**
    *   toSnake
    *
    *   @param string $string
    *   @return string
    */
    private function toSnake(string $string): string
    {
        $replaced = (string)preg_replace_callback(
            '/[A-Z]/',
            fn ($matches) => '_'  . strtolower($matches[0]),
            $string
        );
        
        if (
            substr($replaced, 0, 1) == '_'
            && substr($string, 0, 1) != '_'
        ) {
            return substr($replaced, 1);
        }
        return $replaced;
    }
}
