<?php

/**
*   ValidatorInterface
*
*   @version 200628
*/

declare(strict_types=1);

namespace Movement\standard;

interface ValidatorInterface
{
    /**
    *   validate
    *
    *   @param array $parameters
    */
    public function validate(array $parameters);
}
