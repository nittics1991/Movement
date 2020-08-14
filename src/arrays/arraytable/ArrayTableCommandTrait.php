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
        $dataset = $this->getDataset();
        $selected = [];
        
        foreach($column_names as $name) {
            if (!$this->hasColumnName($name)) {
                throw new RuntimeException(
                    "not has column:{$name}"
                );
            }
            $selected[] = array_column($dataset, $name);
        }
        return $this->setDataset($selected);
    }
    
    /**
    *   selectByColumns
    *
    *   @param string[] $column_names
    *   @return static
    */
    protected function selectByColumns(array $column_names)
    {
        $dataset = $this->getDataset();
        $selected = [];
        
        foreach($column_names as $name) {
            if (!array_key_exists($name, $dataset)) {
                throw new RuntimeException(
                    "not has column:{$name}"
                );
            }
            $selected[] = $dataset[$name];
        }
        return $this->setDataset($selected);
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
        $column = [];
        $added = [];
        
        foreach ($this->getDataset() as $row) {
            $column[$column_name] = call_user_func_array(
                $expression,
                $row
            );
            $added[] = $row + $column;
        }
        
        $this->setDataset($added);
        
        return $this->setColumnName(
            $this->getColumnName + [$column_name]
        );
    }
    
    
    
    
    
    
    
}
