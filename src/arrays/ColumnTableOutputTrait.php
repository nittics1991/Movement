<?php

/**
*   ColumnTableOutputTrait
*
*   @version 200808
*/

declare(strict_types=1);

namespace Movement\arrays;

use InvalidArgumentException;

trait ColumnTableOutputTrait
{
    /**
    *   getInitDataset
    *
    *   @return mixed[]
    */
    protected function getInitDataset():array
    {
        return $this->init_dataset;
    }
    
    /**
    *   getRaw
    *
    *   @return mixed[]
    */
    protected function getRaw():array
    {
        $dataset = $this->dataset;
        unset($dataset[$this->index_name]);
        return $dataset;
    }
    
    /**
    *   columnNames
    *
    *   @return mixed[]
    */
    protected function columnNames():array
    {
        $column_names = $this->column_names;
        unset($column_names[$this->index_name]);
        return $column_names;
    }
    
    /**
    *   all
    *
    *   @return mixed[]
    */
    protected function all():array
    {
        
        
        //$this->index_nameは何に使う?
        
        
        
        $column_names = $this->column_names;
        unset($column_names[$this->index_name]);
        $max_row_no = count($this->init_dataset) - 1;
        
        return array_map(
            function ($row_no) use ($this->dataset, $column_names) {
                
                return $this->dataset[$name][$max_row_no];
                
                
            },
            range(0, count($this->init_dataset) - 1, 1)
        );
        
        
        
        
        
    }
    
    /**
    *   first
    *
    *   @return mixed[]
    */
    protected function first():array
    {
        $column_names = $this->column_names;
        unset($column_names[$this->index_name]);
        
        return array_map(
            function ($name) use ($this->dataset) {
                return $this->dataset[$name][0];
            },
            $column_names
        );
    }
    
    /**
    *   last
    *
    *   @return mixed[]
    */
    protected function last():array
    {
        $max_row_no = count($this->init_dataset) - 1;
        $column_names = $this->column_names;
        unset($column_names[$this->index_name]);
        $max_row_no = count($this->init_dataset) - 1;
        
        return array_map(
            function ($name) use ($this->dataset, $max_row_no) {
                return $this->dataset[$name][$max_row_no];
            },
            $column_names
        );
    }
    
    /**
    *   nth
    *
    *   @param int $row_no
    *   @return mixed[]
    */
    protected function nth(int $row_no):array
    {
        $max_row_no = count($this->init_dataset) - 1;
        
        if (abs($row_no) > $max_row_no) {
            throw new InvalidArgumentException(
                "invalid row no:{$row_no}"
            );
        }
        
        $row_no = $row_no >= 0 ? $row_no : $max_row_no - $row_no;
        
        $column_names = $this->column_names;
        unset($column_names[$this->index_name]);
        $max_row_no = count($this->init_dataset) - 1;
        
        return array_map(
            function ($name) use ($this->dataset, $max_row_no) {
                return $this->dataset[$name][$max_row_no];
            },
            $column_names
        );
    }
    
    
    
    
    
}
