<?php

/**
*   ArrayTableCommonTrait
*
*   @version 200810
*/

declare(strict_types=1);

namespace Movement\arrays\arraytable;

class ArrayTableCommonTrait
{
    /**
    *   rowsDirection
    *
    *   @var bool
    */
    protected array $rowsDirection = true;
    
    /**
    *   dataset
    *
    *   @var mixed[]
    */
    protected array $dataset = [];
    
    /**
    *   column_names
    *
    *   @var string[]
    */
    protected array $column_names = [];
    
    /**
    *   hasColumnName
    *
    *   @return bool
    */
    public function hasColumnName(string $name):bool
    {
        return in_array($name, $this->column_name);
    }
    
    /**
    *   getColumnName
    *
    *   @return string[]
    */
    public function getColumnName():array
    {
        return $this->column_name;
    }
    
    /**
    *   setColumnName
    *
    *   @param string[] $names
    *   @return static
    */
    protected function setColumnName(array $names)
    {
        $this->column_name = $names;
        return $this;
    }
    
    /**
    *   isRowsDirection
    *
    *   @return bool
    */
    protected function isRowsDirection() :bool
    {
        return $this->rowsDirection;
    }
    
    /**
    *   isColumnsDirection
    *
    *   @return bool
    */
    protected function isColumnsDirection() :bool
    {
        return !$this->rowsDirection;
    }
    
    /**
    *   setRowsDirection
    *
    *   @return static
    */
    protected function setRowsDirection()
    {
        return $this->rowsDirection = true;
    }
    
    /**
    *   setColumnsDirection
    *
    *   @return static
    */
    protected function setColumnsDirection()
    {
        return $this->rowsDirection = false;
    }
    
    /**
    *   getDataset
    *
    *   @return array[]
    */
    protected function getDataset()
    {
        return $this->dataset;
    }
    
    /**
    *   setDataset
    *
    *   @param array[]
    *   @return static
    */
    protected function setDataset(array $dataset)
    {
        $this->dataset = $dataset
        return $this;
    }
    
    /**
    *   transverse
    *
    *   @param array[] $dataset
    *   @return void
    */
    protected function transverse(
        array $dataset
    ) :void {
        $column_names = array_keys($dataset);
        
        foreach($column_names as $name) {
            $this->dataset[$name] = array_columns(
                $dataset,
                $name
            );
        }
    }
    
    /**
    *   toRows
    *
    *   @return void
    */
    protected function toRows()
    {
        if ($this->isRowsDirection()) {
            $this->transeverse();
        }
    }
    
    /**
    *   toColumns
    *
    *   @return void
    */
    protected function toColumns()
    {
        if ($this->isColumnsDirection()) {
            $this->transeverse();
        }
    }
}
