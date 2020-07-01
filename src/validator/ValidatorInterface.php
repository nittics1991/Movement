<?php

/**
*   ValidatorInterface
*
*   @version 200701
*/

declare(strict_types=1);

namespace Movement\validator;

interface ValidatorInterface
{
    /**
    *   validate
    *
    *   @param mixed $value
    *   @param array $parameters
    */
    public function validate(
        $value,
        array $parameters = []
    );
}
