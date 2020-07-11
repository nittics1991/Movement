<?php

/**
*   ValidatorRuleResolverInterface
*
*   @version 200704
*/

declare(strict_types=1);

namespace Movement\validator;

interface ValidatorRuleResolverInterface
{
    /**
    *   resolve
    *
    *   @param mixed $rules
    *   @return array
    *       [
    *           @param callable $validator
    *           @param array parameters
    *       ]
    */
    public function resolve($rules): array;
}
