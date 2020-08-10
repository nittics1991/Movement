<?php

/**
*   ArrayTable
*
*   @version 200808
*/

declare(strict_types=1);

namespace Movement\arrays\arraytable;

use Movement\arrays\arraytable{
    ArraTableCommandTrait,
    ArraTableInformationTrait,
    ArraTableOutputTrait,
    ArrayTableInterface
};

class ArrayTable implements ArrayTableInterface
{
    use ArraTableCommandTrait;
    use ArraTableInformationTrait;
    use ArraTableOutputTrait;
    
    //作るか?
    //getDataset,setDataset,getColumnNames,setColumnNames
    //isColumnsDirection,isRowsDirection ==>const不要?
    //hasColumn ==> informationTrait
    
    
    /**
    *   direction
    *
    *   @var int
    */
    const protected ROWS = 0;
    const protected COLUMNS = 1;
    
    /**
    *   direction
    *
    *   @var int
    */
    protected array $direction = static::ROWS;
    
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
    *   __construct
    *
    *   @param array[] $array
    */
    public function __construct(
        array $array
    ) {
        $this->transverse($array);
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
        $this->column_names = array_keys($dataset);
        
        foreach($this->column_names as $name) {
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
        //isColumnsDirection 作るか
        
        
        if ($this->direction == static::COLUMNS) {
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
        if ($this->direction == static::ROWS) {
            $this->transeverse();
        }
    }
}
