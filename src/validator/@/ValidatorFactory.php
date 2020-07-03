<?php

/**
*   ValidatorFactory
*
*   @version 200704
*/

declare(strict_types=1);

namespace Movement\validator;

use InvalidArgumentException;
use Movement\validator\ValidatorFactoryInterface;

class ValidatorFactory implements
    ValidatorFactoryInterface
{
    /**
    *   validators
    *
    *   @var ValidatorInterface[]|callable[]
    */
    private $validators = [];
    
    /**
    *   has
    *
    *   @param string $name
    *   @return ValidatorInterface|callable
    */
    public function has(string $name)
    {
        return isset($this->validators[$name]);
    }
    
    /**
    *   {inherit}
    *
    */
    public function get(string $name)
    {
        if (!$this->has($name)) {
            throw new InvalidArgumentException(
                "not defined rule:{$name}"
            );
        }
        return $this->validators[$name];
    }
}
