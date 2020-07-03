<?php

/**
*   InputValueObject
*
*   @version 200628
*/

declare(strict_types=1);

namespace Movement\standard;

use Movement\accessor\{
    CastByPropertyTypeTrait,
    CastByPropertyTypeTraitInterface,
    ReflectePropertyTrait,
    ReflectePropertyTraitInterface
};
use Movement\validator\ValidatorRuleDefinedInterface;

class InputValueObject implements ReflectePropertyTraitInterface,
    CastByPropertyTypeTraitInterface,
    ValidatorRuleDefinedInterface
{
    use ReflectePropertyTrait;
    use CastByPropertyTypeTrait;
    
    /**
    *   definition properties
    */
    
    /**
    *   definition has need in children class
    */
    //private array $casts = [];
    
    /**
    *   validator_rules
    *
    *   @val array
    */
    private array $validator_rules = [];
    
    /**
    *   __construct
    *
    *   @param array $parameters
    */
    public function __construct(
        array $parameters
    ): {
        $casted = $this->castAggregateToArray($parameters);
        $this->fromAggregate($casted);
    }
    
    /**
    *   {inherit}
    *
    */
    public function getValidatorRules(): array
    {
        return $this->validator_rules;
    }
    
    /**
    *   {inherit}
    *
    */
    public function getValidatorValues(): array
    {
        return $this->toArray();
    }
}
