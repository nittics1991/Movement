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

class InputValueObject implements ReflectePropertyTraitInterface,
    CastByPropertyTypeTraitInterface
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
}
