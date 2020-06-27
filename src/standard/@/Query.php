<?php

/**
*   Query
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

class Query implements ReflectePropertyTraitInterface,
    CastByPropertyTypeTraitInterface
{
    use ReflectePropertyTrait;
    use CastByPropertyTypeTrait;
    
    /**
    *   definition has need in children class
    */
    //private array $properties = [];
    
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
