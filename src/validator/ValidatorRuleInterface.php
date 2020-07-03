<?php

/**
*   ValidatorRuleInterface
*
*   @version 200704
*/

declare(strict_types=1);

namespace Movement\validator;

interface ValidatorRuleInterface
{
    /**
    *   validate
    *
    *   @param mixed $value
    *   @param array $parameters
    *   @return bool
    */
    public function validate(
        $value,
        array $parameters = []
    ): bool;
}
