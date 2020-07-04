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
        $this->positiveRule();
        $this->negativeRule();
        $this->otherRule();
    }
    
    /**
    *   positiveRule
    *
    */
    private function positiveRule()
    {
        foreach ($this->methods as $method) {
            $this->rules[$method] = $this->toSnake($method);
        }
    }
    
    /**
    *   negativeRule
    *
    */
    private function negativeRule()
    {
        foreach ($this->methods as $method) {
            $callback = $this->toSnake($method);
            $name = $this->toNegativeName($method);
            $this->rules[$name] = fn($v) => !$callback($v);
        }
    }
    
    /**
    *   otherRule
    *
    */
    private function otherRule()
    {
        $this->methods['isTrue'] = fn($v) => $v == true;
        $this->methods['isFalse'] = fn($v) => $v == false;
        $this->methods['isEmpty'] = fn($v) => empty($v);
        $this->methods['isNotEmpty'] = fn($v) => !empty($v);
        $this->methods['isBlank'] = fn($v) => $v == '';
        $this->methods['isNotBlank'] = fn($v) => $v != '';
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
    
    /**
    *   toNegativeName
    *
    *   @param string $string
    *   @return string
    */
    private function toNegativeName(string $string): string
    {
       return substr($string, 0, 2) . 'Not' . substr($string, 2);
    }
}
