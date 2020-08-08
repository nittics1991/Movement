<?php

/**
*   ColumnTableOutputTrait
*
*   @version 200808
*/

declare(strict_types=1);

namespace Movement\arrays;

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
    }
    
    /**
    *   first
    *
    *   @return mixed[]
    */
    protected function first():array
    {
        
        //行列変換？
        
        
        $data = reset($this->dataset);
        unset($data[$this->index_name]);
        return $data;
    }
    
    /**
    *   last
    *
    *   @return mixed[]
    */
    protected function last():array
    {
        
        
        
        
        $data = end($this->dataset);
        unset($data[$this->index_name]);
        return $data;
    }
    
    /**
    *   nth
    *
    *   @param int $row_no
    *   @return mixed[]
    */
    protected function nth(int $row_no):array
    {
    }
    
    /**
    *   get
    *
    *   @return mixed[]
    */
    protected function get():array
    {
    }
    
    /**
    *   get
    *
    *   @return mixed[]
    */
    protected function get():array
    {
    }
}
