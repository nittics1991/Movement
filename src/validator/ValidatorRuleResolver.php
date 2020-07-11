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
    */
    private ContainerInterface $container;
    
    /**
    *   {inherit}
    *
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
        
        foreach ($functions => $function) {
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
        return $this->repairEscapeCharacters($exploded, ',')
        
        
        
        
    }
    
    /**
    *   explodeFunction
    *
    *   @param string $function
    *   @return array
    */
    private function explodeFunction($function): array
    {
        
        
        return explode(':', $rules);
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
        for($i = 0; $i < count($values); $i++) {
            if (mb_substr($values[$i], -1, 1) == '\\') {
                $result[] = isset($values[$i + 1])?
                    mb_substr($values[$i], 0, mb_strlen($values[$i]) - 1)
                            . "{$character}{$values[$i + 1]}":
                        $values[$i];
            }
        }
        return $result;
    }
}
