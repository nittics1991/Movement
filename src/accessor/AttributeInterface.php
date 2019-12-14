<?php

/**
*   AttributeInterface
*
*   @version 190517
**/
declare(strict_types=1);

namespace Movement\accessor;

interface AttributeInterface
{
    /**
    *   プロパティが定義されている|定義取得
    *
    *   @param ?string $name
    *   @return bool|array
    **/
    public function definedProperty(?string $name = null);
    
    /**
    *   データが存在
    *
    *   @param string $name
    *   @return bool
    **/
    public function has(string $name): bool;
}
