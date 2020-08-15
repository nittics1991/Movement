<?php

/**
*   ArrayTableCommandTrait
*
*   @version 200810
*/

declare(strict_types=1);

namespace Movement\arrays\arraytable;

use RuntimeException;
//use Movement\arrays\arraytable\ArrayTableCommonTrait;

trait ArrayTableCommandTrait
{
    //実際に構築するclassでuse?
    //use ArrayTableCommonTrait;
    
    //datasetへの保存はsetDatasetでも良い
    //dataset取得はpropertyかiteratorがgetDatasetより小メモリ
    
    
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
    public function orderBy(
        array $column_names,
        array $sort_orders = [],
        array $sort_flags = [],
    ) {
        $this->toColumns();
        
        $this->column_names = $column_names + $this->column_names;
        
        $orders = [];
        foreach ($column_names as $name) {
            $orders[] = $sort_orders[$name]?? SORT_ASC;
        }
        
        $flags = [];
        foreach ($column_names as $name) {
            $flags[] = $sort_flags[$name]?? SORT_NATURAL;
        }
        
        $arguments = call_user_func_array(
            'array_merge',
            array_map(
                fn ($name, $order, $flag) => [$name, $order, $flag],
                $this->column_names,
                $orders,
                $flags
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
        return $this;
    }
    
    /**
    *   {inherit}
    *
    *   @param string ...$column_names
    *   @return static
    */
    public function selectBy(string ...$column_names)
    {
        return $this->isRowsdirection()?
            $this->selectByRows($column_names):
            $this->selectByColumns($column_names);
    }
    
    /**
    *   selectByRows
    *
    *   @param string[] $column_names
    *   @return static
    */
    protected function selectByRows(array $column_names)
    {
        $selected = [];
        
        foreach($column_names as $name) {
            if (!$this->hasColumnName($name)) {
                throw new RuntimeException(
                    "not has column:{$name}"
                );
            }
            $selected[] = array_column($this->dataset, $name);
        }
        $this->dataset = $selected;
        return $this;
    }
    
    /**
    *   selectByColumns
    *
    *   @param string[] $column_names
    *   @return static
    */
    protected function selectByColumns(array $column_names)
    {
        $selected = [];
        
        foreach($column_names as $name) {
            if (!array_key_exists($name, $this->dataset)) {
                throw new RuntimeException(
                    "not has column:{$name}"
                );
            }
            $selected[] = $this->dataset[$name];
        }
        $this->dataset = $selected;
        return $this;
    }
    
    /**
    *   {inherit}
    *
    */
    public function addColumn(
        string $column_name,
        callable $expression
    ) {
        $this->toRows();
        
        foreach ($this->dataset as &$row) {
            $row[$column_name] = call_user_func_array(
                $expression,
                $row
            );
        }
        return $this;
    }
    
    /**
    *   {inherit}
    *
    */
    public function join(
        $joined_table,
        array $column_map,
        array $alias
    ) {
        
        //generatorを使いたい
        //無名function ?
        
        
        
        $targets = $joind_table->orderBy(
            array_keys($column_map)
        )->toColumnsArray();
        
        $this->orderBy(
            array_keys($column_map)
        );
        
        
        
        
        
        $joined = [];
        $previous_keys = [];
        $matched_position = 0;
        $matched_length = 0;
        
        foreach ($this->dataset as $columns_array) {
            foreach ($column_map as $soruce_column => $target_column) {
                
                
            }
            
        }
        
        
        
    }
    
    /**
    *   aaa
    *
    *   @param string[] $column_names
    *   @return static
    */
    protected function aaa($joined_table)
    {
        
        
        foreach ($targets as $columns_array) {
            
            
        }
    }
    
    
    /**
    *   joinedTargetGenerator
    *
    *   @param string[] $column_names
    *   @return static
    */
    protected function joinedTargetGenerator(
        $targets,
        
    {
        
        
        
        foreach ($targets as $columns_array) {
            
            
        }
    }
    
    
    
    
    
}
