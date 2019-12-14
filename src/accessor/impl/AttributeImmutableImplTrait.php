<?php

/**
*   AttributeImmutableImplTrait
*
*   @version 190517
**/
declare(strict_types=1);

namespace Movement\accessor\impl;

use Movement\accessor\AttributeImmutableTrait;
use Movement\accessor\impl\AttributeImplTrait;

trait AttributeImmutableImplTrait
{
    use AttributeImplTrait, AttributeImmutableTrait {
            AttributeImmutableTrait::__set insteadof AttributeImplTrait;
            AttributeImmutableTrait::__unset insteadof AttributeImplTrait;
    }
}
