<?php

/**
*   RestrictToSetterGettertImplTrait
*
*   @version 190517
**/
declare(strict_types=1);

namespace Concerto\accessor\impl;

use BadMethodCallException;
use Concerto\accessor\impl\SetterGettertImplTrait;

trait RestrictToSetterGettertImplTrait
{
    use SetterGettertImplTrait;
    
    /**
    *   {inherit}
    *
    **/
    public function __set(string $name, $value): void
    {
        if (!$this->calledFromSetter()) {
            throw new \BadMethodCallException(
                "must be use setter method"
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
        if (!$this->calledFromGetter()) {
            throw new \BadMethodCallException(
                "must be use getter method"
            );
        }
        return $this->getDataFromContainer($name);
    }
    
    /**
    *   {inherit}
    *
    **/
    public function __unset(string $name): void
    {
        throw new \BadMethodCallException(
            "must be use setter method"
        );
    }
}
