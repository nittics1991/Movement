<?php

/**
*   AbstractValidatorRuleProvider
*
*   @version 200704
**/

namespace Movement\validator;

use Closure;
use RuntimeException;
use Movement\container\provider\AbstractServiceProvider;

abstract class AbstractValidatorRuleProvider extends
    AbstractServiceProvider
{
    /**
    *   {inherit}
    *
    */
    protected $provides = [];
    
    /**
    *   rules
    *
    *   @var callable[]
    *   @example name => fn(mixed $value, array $parameters)
    */
    protected $rules = [];
    
    /**
    *   __construct
    *
    */
    public function __construct()
    {
        $this->setRules();
        $this->provides = array_keys($this->rules);
    }
    
    /**
    *   setRules
    *   user has to make $this->rules    
    */
    abstract protected function setRules();
    
    /**
    *   {inherit}
    *
    */
    public function register()
    {
        foreach ($this->rules as $name => $rule) {
            if (!($rule instanceof Closure)) {
                throw RuntimeException(
                    "rule must be Closure:{$name}"
                );
            }
            
            $this->bind($name, function($container) use ($rule) {
                return $rule;
            });
        }
    }
}
