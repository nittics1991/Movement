<?php

/**
*   BusinessDateFactory
*
*   @version 200802
*/

declare(strict_types=1);

namespace Movement\arrays;

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
    *       [0 => index, ...]
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
    //protected array $index_name = '';
    
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
        
        $this->column_names = array_keys(
            (array)reset($this->init_dataset)
        );
        
        //$this->index_name = bin2hex(random_bytes(8));
        
        //$this->dataset[$this->index_name] =
        $this->dataset[] = range(0, count($this->init_dataset), 1);
        
        foreach($this->column_names as $name) {
            $this->dataset[] = array_columns(
                $this->init_dataset,
                $name
            );
        }
    }
    
    //getInitDataset()
    //toArray()
    //keys()
    
    
    
    /**
    *   first
    *
    *   @param array $array
    */
    protected function fromConfigArray(
        array $array
    ) {
        if ()
        
        
        
        
        
    }
    
    
    
    
    
    /**
    *   now
    * 
    *   @return DateTimeInterface
    */
    public function now(): DateTimeInterface
    {
        return new $this->datetime_fqn(
            "now",
            $this->timezone
        );
    }
    
    /**
    *   today
    * 
    *   @return DateTimeInterface
    */
    public function today(): DateTimeInterface
    {
        if ($this->datetime_fqn == DateTime::class) {
            return call_user_func(
                'date_create_from_format',
                "!{$this->date_create_format}",
                "now",
                $this->timezone
            );
        }
        
        return call_user_func(
            'date_create_immutable_from_format',
            "!{$this->date_create_format}",
            "now",
            $this->timezone
        );
    }
    
    /**
    *   thisMohth
    * 
    *   @return DateTimeInterface
    */
    public function thisMohth(): DateTimeInterface
    {
    }
    
    /**
    *   thisQuarter
    * 
    *   @return DateTimeInterface
    */
    public function thisQuarter(): DateTimeInterface
    {
    }
    
    
    
    
    
    /**
    *   thisFiscalYear
    * 
    *   @return DateTimeInterface
    */

/*
    public function thisFiscalYear(): DateTimeInterface
    {
        $interval = $this->today()->diff(
            $this->datetime_fqn::createFromFormat(
                "!Ym",
                date('Y') . $this->start_month
            )
        );
        
        $year = (int)date('Y') + $interval->y * $interval->invert;
        
        
        
        
        if ($interval->invert > 0) {
            
            $ ($interval->m >= 0 && $interval->m <= 6) {
                
            }
        }
        
        
        return $this->createFromFiscalYearFormat($code)
        
        
        
        
        
        202004
        
        9
        10
        11
        12
        1
        202102  202104 -2 ==> YYYY-1
        3
        
        
        0 > x >= -6 =S
        -6 > x =K
        
        
        
        
        return new $this->datetime_fqn(
            "!{$this->datetime_format}"
        );
    }
    
 */   
    
    
    
    
    
    
    
}
