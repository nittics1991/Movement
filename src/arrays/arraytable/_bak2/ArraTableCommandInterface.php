<?php

/**
*   ArraTableCommandInterface
*
*   @version 200810
*/

declare(strict_types=1);

namespace Movement\arrays\arraytable;

interface ArraTableCommandInterface
{
    /**
    *   where
    *
    *   @param callable $condition
    *   @return static
    */
    public function where(
        callable $condition
    );
    
    /**
    *   orderBy
    *
    *   @param string[] $column_names
    *   @param int[] $sort_orders
    *   @param int[] $sort_flags
    *   @return static
    */
    public function orderBy(
        array $column_names,
        array $sort_orders,
        array $sort_flags
    );
    
    /**
    *   selectBy
    *
    *   @param string ...$column_names
    *   @return static
    */
    public function selectBy(string ...$column_names);
    
    /**
    *   addColumn
    *
    *   @param callable $expression
    *   @return static
    */
    public function addColumn(callable $expression);
    
    /**
    *   join
    *
    *   @param static $joined_table
    *   @param array $column_map [column_name => column_name, ...]
    *   @param array $alias [column_name => alias_name, ...]
    *   @return static
    */
    public function join(
        $joined_table,
        array $column_map,
        array $alias
    );
    
    /**
    *   leftJoin
    *
    *   @param static $joined_table
    *   @param array $column_map [column_name => column_name, ...]
    *   @param array $alias [column_name => alias_name, ...]
    *   @return static
    */
    public function leftJoin(
        $joined_table,
        array $column_map,
        array $alias
    );
    
    //crossJoin
    //fullJoin
    
    /**
    *   union
    *
    *   @param static $joined_table
    *   @return static
    */
    public function union($joined_table);
    
    /**
    *   unionAll
    *
    *   @param static $joined_table
    *   @return static
    */
    public function unionAll($joined_table);    //union利用
    
    //intersect
    //intersectAll
    //except
    //exceptAll
}
