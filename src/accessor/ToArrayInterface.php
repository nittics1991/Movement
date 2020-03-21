<?php

/**
*   ToArrayInterface
*
*   @version 190520
*/

declare(strict_types=1);

namespace Concerto\accessor;

interface ToArrayInterface
{
    /**
    *   配列へ変換
    *
    *   @return array
    **/
    public function toArray();
}
