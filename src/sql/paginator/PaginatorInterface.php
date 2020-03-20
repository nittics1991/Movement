<?php

/**
*   PaginatorInterface
*
*   @ver 200307
**/
declare(strict_types=1);

namespace Concerto\sql\paginator;

interface PaginatorInterface
{
    /**
    *   paginate
    *
    *   @param int $pageNo
    */
    public function paginate(int $pageNo);
}
