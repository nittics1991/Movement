<?php

/**
*   Validator
*
*   @version 200704
*/

declare(strict_types=1);

namespace Movement\validator;

use Movement\validator\{
    ValidatorException,
    ValidatorInterface,
    ValidatorRuleInterface,
    ValidatorRuleResolverInterface
};

class Validator implements ValidatorInterface
{
    /**
    *   resolver
    *
    *   @var ValidatorRuleResolverInterface
    */
    private $resolver;
    
    /**
    *   errors
    *
    *   @var ValidatorException[]
    */
    private $errors = [];
    
    /**
    *   __construct
    *
    *   @param ValidatorRuleResolverInterface $resolver
    */
    public function __construct(
        ValidatorRuleResolverInterface $resolver
    ) {
        $this->resolver = $resolver;
    }
    
    /**
    *   {inherit}
    *
    */
    public function validate(
        array $values,
        array $rules
    ) {
        $this->errors = [];
        
        foreach ($rules as $name => $rule) {
            if (isset($values[$name])) {
                $this->doValidate($name, $val, $rule);
            }
        }
        return empty($this->errors);
    }
    
    /**
    *   doValidate
    *
    *   @param string $name
    *   @param mixed $value
    *   @param mixed $rule
    */
    private function doValidate(
        string $name,
        $value,
        $rule
    ) {
        list($validator, $parameters) = $this->resolver->resolve($rule);
        
        $result = call_user_func_array(
            $validator,
            array_merge([$value], $parameters)
        );
        
        if ($result == false) {
             $this->errors[$name][] =
                new ValidatorException(
                    $name,
                    $value
                );
        }
    }
    
    /**
    *   errors
    *
    *   @return array
    */
    public function errors(): array
    {
        return $this->errors;
    }
}
