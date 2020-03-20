<?php

/**
*   Array Paginator
*
*   @ver 200307
*/
declare(strict_types=1);

namespace Concerto\sql\paginator;

use Concerto\sql\paginator\{
    BasePaginator,
    PaginatorInterface
};

class ArrayPaginator extends BasePaginator implements
    PaginatorInterface
{
    /**
    *   __construct
    *
    *   @param array $array
    *   @param int $pageSize
    */
    public function __construct(
        array $array,
        int $pageSize
    ) {
        parent::__construct($array, $pageSize);
    }
    
    /**
    *   {inherit}
    *
    */
    public function paginate(int $pageNo = 1)
    {
        $this->container['current_page'] = $pageNo;
        
        $this->container['data'] = array_slice(
            $this->iterate,
            $this->container['page_size'] * ($pageNo - 1),
            $this->container['page_size']
        );
        
        $this->container['total'] = count($this->iterate);
        $this->container['last_page'] =
            $this->container['total'] / $this->container['page_size']
            + (($this->container['total'] % $this->container['page_size']) > 0?
             1:0);
        
        return $this;
    }
}
