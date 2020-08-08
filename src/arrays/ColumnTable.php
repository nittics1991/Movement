<?php

/**
*   BusinessDateFactory
*
*   @version 200808
*/

declare(strict_types=1);

namespace Movement\arrays;

use RuntimeException;

class ColumnTable
{
    /**
    *   init_dataset
    *
    *   @var mixed[]
    */
    protected array $init_dataset = [];
    
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
    *   index_name
    *
    *   @var string
    */
    protected array $index_name = '';
    
    /**
    *   __construct
    *
    *   @param array $array
    */
    public function __construct(
        array $array
    ) {
        $this->init($array);
    }
    
    /**
    *   init
    *
    *   @param array $array
    */
    protected function init(
        array $array
    ) :void {
        $this->init_dataset = $array;
        
        $this->index_name = bin2hex(random_bytes(8));
        
        $this->column_names = array_merge(
            [$this->index_name],
            array_keys(
                (array)reset($this->init_dataset)
            )
        );
        
        $this->dataset[$this->index_name] =
            range(0, count($this->init_dataset), 1);
        
        foreach($this->column_names as $name) {
            $this->dataset[$name] = array_columns(
                $this->init_dataset,
                $name
            );
        }
    }
    
    //get処理のtraitに作る?
    //getInitDataset()
    //toArray()
    //keys()
    
    
    
    /**
    *   sort
    *
    *   @param string[] $column_names
    *   @param int[] $sort_orders
    *   @param int[] $sort_flags
    *   @return $this
    */
    protected function sort(
        array $column_names,
        array $sort_orders,
        array $sort_flags
    ) :ColumnTable {
        $columns = [$this->index_name]
            + $column_names
            + $this->column_names;
        
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
}
