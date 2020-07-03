<?php

/**
*   ValidatorFactoryInterface
*
*   @version 200704
*/

declare(strict_types=1);

namespace Movement\validator;

interface ValidatorFactoryInterface
{
    /**
    *   get
    *
    *   @param string $name
    *   @return ValidatorInterface|callable
    */
    public function get(string $name);
}
