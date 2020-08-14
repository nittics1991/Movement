<?php

/**
*   ArrayTableOutputInterface
*
*   @version 200810
*/

declare(strict_types=1);

namespace Movement\arrays\arraytable;

interface ArrayTableOutputInterface
{
    /**
    *   toColumnsArray
    *
    *   @return array[]
    */
    public function toColumnsArray():array;
    
    /**
    *   toRowsArray
    *
    *   @return array[]
    */
    public function toRowsArray():array;
    
    /**
    *   all
    *
    *   @return array[]
    */
    public function all():array; //toRowsArrayをwrap
    
    /**
    *   rows
    *
    *   @param int $offset
    *   @param int $length
    *   @return array[]
    */
    public function rows(int $offset = 0, int $length = 1):array;
    
    /**
    *   row
    *
    *   @param int $row_no
    *   @return mixed[]
    */
    public function row(int $row_no = 0):array; //rowsを利用
    
    /**
    *   firstRow
    *
    *   @return mixed[]
    */
    public function firstRow():array; //rowsを利用
    
    /**
    *   lastRow
    *
    *   @return mixed[]
    */
    public function lastRow():array; //rowsを利用
    
    /**
    *   columns
    *
    *   @param string ...$column_name
    *   @return array[]
    */
    public function columns(string ...$column_name):array;
    
    /**
    *   column
    *
    *   @param string $column_name
    *   @return mixed[]
    */
    public function column(string $column_name):array; //columnsを利用
    
    /**
    *   cell
    *
    *   @param int $row_no
    *   @param string $column_name
    *   @return mixed[]
    */
    public function cell(int row_no, string $column_name):array; //rowsを利用
}
