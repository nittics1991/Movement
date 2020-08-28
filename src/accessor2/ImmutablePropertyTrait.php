<?php

/**
*   ReflectAttributeTrait
*
*   @version 200801
*
*/

declare(strict_types=1);

namespace Movement\accessor;

use InvalidArgumentException;

trait ImmutablePropertyTrait
{
    /**
    *   getImmutableData
    *
    *   @param string $name
    *   @return mixed
    *       __get()に追加する
    */
    protected function getImmutableData(string $name)
    {
        if ($this->has($name)) {
            return $this->$name;
        }
        throw new InvalidArgumentException(
            "property is not defined:{$name}"
        );
    }
    
    /**
    *   isWritable
    *
    *   @param string $name
    *   @return bool
    */
    public function isWritable(string $name): bool
    {
        
        
        
    }
}
