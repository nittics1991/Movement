<?php

/**
*   ArraTableCommandTrait
*
*   @version 200810
*/

declare(strict_types=1);

namespace Movement\arrays\arraytable;

use RuntimeException;

trait ArraTableCommandTrait
{
    /**
    *   {inherit}
    *
    */
    public function where(
        callable $condition
    ) {
        $this->toRows();
        
        $this->dataset = array_filter(
            $this->dataset,
            $condition
        );
        return $this;
    }
    
    /**
    *   {inherit}
    *
    */
    protected function orderBy(
        array $column_names,
        array $sort_orders,
        array $sort_flags
    ) {
        $this->toColumns();
        
        $columns = $column_names + $this->column_names;
        
        $arguments = call_user_func_array(
            'array_merge',
            array_map(
                fn ($name, $order, $flag) => [$name, $order, $flag],
                $columns,
                $sort_orders,
                $sort_flags
            )
        );
        
        if ($arguments == false) {
            throw new RuntimeException(
                "failed to build arguments"
            );
        }
        
        $sorted = call_user_func_array(
            'array_multisort',
            $arguments
        );
        
        if ($sorted == false) {
            throw new RuntimeException(
                "failed to build arguments"
            );
        }
        
        $this->dataset = $sorted;
        $this->column_names = $columns;
    }
    
    /**
    *   {inherit}
    *
    *   @param string ...$column_names
    *   @return static
    */
    public function selectBy(string ...$column_names)
    {
        $result = [];
        
        if ($this->direction == static::COLUMNS) {
            
            
            
        }
        
        
        foreach($column_names as $name) {
            
        }
        
        
    }
    
    
    
    
    
    
    
}
