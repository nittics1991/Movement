<?php

/**
*   PDOStatement Paginator
*
*   @ver 200307
**/
declare(strict_types=1);

namespace Concerto\sql\paginator;

use PDO;
use PDOStatement;
use Concerto\sql\paginator\{
    BasePaginator,
    PaginatorInterface
};

class PDOStatementPaginator extends BasePaginator implements
    PaginatorInterface
{
    /**
    *   __construct
    *
    *   @param PdoStatement $pdoStatement
    *   @param int $pageSize
    */
    public function __construct(
        PDOStatement $pdoStatement,
        int $pageSize
    ) {
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        parent::__construct($pdoStatement, $pageSize);
    }
    
    /**
    *   {inherit}
    *
    */
    public function paginate(int $pageNo = 1)
    {
        $this->container['current_page'] = $pageNo;
        
        $min = $this->container['page_size'] * ($pageNo - 1);
        $max = $this->container['page_size'] + $min;
        $cnt = 0;
        
        foreach ($this->iterate as $list) {
            if ($cnt >= $min && $cnt < $max) {
                $this->container['data'][] = $list;
            }
            $cnt++;
        }
        $this->container['total'] = $cnt;
        $this->container['last_page'] =
            $cnt / $this->container['page_size']
            + ($cnt % $this->container['page_size']) > 0? 1:0;
        
        return $this;
    }
}
