<?php

/**
*   ArraTableCommandTrait
*
*   @version 200810
*/

declare(strict_types=1);

namespace Movement\arrays\arraytable;

use RuntimeException;
//use Movement\arrays\arraytable\ArrayTableCommonTrait;

trait ArraTableCommandTrait
{
    //実際に構築するclassでuse?
    //use ArrayTableCommonTrait;
    
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
        
        $columns = $column_names + $this->getColumnNames();
        
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
        
        $this->setDataset($sorted);
        $this->setColumnNames($columns);
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
