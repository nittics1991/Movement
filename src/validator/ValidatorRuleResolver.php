<?php

/**
*   ValidatorRuleResolver
*
*   @version 200712
*/

declare(strict_types=1);

namespace Movement\validator;

use Psr\container\ContainerInterface;
use Movement\validator\ValidatorRuleResolverInterface;

class ValidatorRuleResolver implements ValidatorRuleResolverInterface
{
    /**
    *   container
    *
    *   @var ContainerInterface
    */
    private ContainerInterface $container;
    
    /**
    *   __construct
    *
    *   @param ContainerInterface
    */
    public function __construct(
        ContainerInterface $container
    ) {
        $this->container = $container;
    }
    
    /**
    *   {inherit}
    *
    */
    public function resolve($rules): array
    {
        if (!is_string($rules)) {
            throw new InvalidArgumentException(
                "rule must be string"
            );
        }
        
        $functions = $this->explodeRules($rules);
        $validator_parameters = [];
        
        foreach ($functions as $function) {
            $validator_parameters[] =
                $this->explodeFunction($function);
        }
        return $validator_parameters;
    }
    
    /**
    *   explodeRules
    *
    *   @param string $rule
    *   @return array
    */
    private function explodeRules($rules): array
    {
        $exploded = explode(',', $rules);
        return $this->repairEscapeCharacters($exploded, ',');
    }
    
    /**
    *   explodeFunction
    *
    *   @param string $function
    *   @return array
    */
    private function explodeFunction($function): array
    {
        $exploded = explode(':', $rules);
        $escaped = $this->repairEscapeCharacters($exploded, ':');
        $function_name = array_shift($escaped);
        
        if (!$this->container->has($function_name)) {
            throw new InvalidArgumentException(
                "not defined rule:{$function_name}"
            );
        }
        return [
            $this->container->get($function_name),
            $escaped
        ];
    }
    
    /**
    *   repairEscapeCharacters
    *
    *   @param string $function
    *   @return array
    */
    private function repairEscapeCharacters(
        array $values,
        string $character
    ): array {
        $result = [];
        $stack = '';
        
        
        //要みなおし
        /*
        for($i = 0; $i < count($values); $i++) {
            if (mb_substr($values[$i], -1, 1) == '\\') {
                $stack .= mb_substr($values[$i], 0, mb_strlen($values[$i]) - 1)
                    . $character;
            } else {
                $result[] = "{$stack}{$values[$i]}";
                $stack = '';
            }
        }
        if (!empty($stack)) {
            $result[] = $values[$i - 1];
        }
        */
        
        foreach($values as $value) {
            if (mb_substr($value, -1, 1) == '\\') {
                $stack .= mb_substr($value, 0, mb_strlen($value) - 1)
                    . $character;
            } else {
                $result[] = "{$stack}{$value}";
                $stack = '';
            }
        }
        if (!empty($stack)) {
            $result[] = $values[count($values) - 1];
        }
        return $result;
    }
}
