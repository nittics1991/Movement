<?php

/**
*   ValidaterRuleDefinedInterface
*
*   @version 200628
*/

declare(strict_types=1);

namespace Movement\standard;

interface ValidaterRuleDefinedInterface
{
    /**
    *   getValidatorRules
    *
    *   @return array
    */
    public function getValidatorRules(): array;
    
    /**
    *   getValidatorValues
    *
    *   @return array
    */
    public function getValidatorValues(): array;
}
