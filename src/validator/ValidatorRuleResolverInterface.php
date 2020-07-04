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
    *   @param mixed $rule
    *   @return array
    *       [
    *           @param callable $validator
    *           @param array parameters
    *       ]
    */
    public function resolve($rule): array;
}
