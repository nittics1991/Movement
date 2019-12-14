<?php

/**
*   TypeCastImplTrait
*
*   @version 190517
**/
declare(strict_types=1);

namespace Movement\accessor\impl;

use Movement\accessor\impl\AttributeImplTrait;
use Movement\accessor\TypeCastTrait;

trait TypeCastImplTrait
{
    use AttributeImplTrait;
    use TypeCastTrait;
    
    /**
    *   {inherit}
    *
    **/
    public function __set(string $name, $value): void
    {
        if ($this->hasSetCastType($name)) {
            $value = $this->toCastDataType(
                $this->setCastType($name),
                $value
            );
        }
        $this->setDataToContainer($name, $value);
    }
    
    /**
    *   {inherit}
    *
    **/
    public function __get(string $name)
    {
        $value = $this->getDataFromContainer($name);
        
        if ($this->hasGetCastType($name)) {
            return $this->toCastDataType(
                $this->getCastType($name),
                $value
            );
        }
        return $value;
    }
}
