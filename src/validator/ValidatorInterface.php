<?php

/**
*   ValidatorInterface
*
*   @version 200704
*/

declare(strict_types=1);

namespace Movement\validator;

interface ValidatorInterface
{
    /**
    *   validate
    *
    *   @param array $values
    *   @param array $rules
    */
    public function validate(
        array $values,
        array $rules
    );
}
