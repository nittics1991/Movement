<?php

/**
*   BusinessDateAttributeTrait
*
*   @version 200802
*/

declare(strict_types=1);

namespace Movement\datetime;

trait BusinessDateAttributeTrait
{
    /**
    *   timezone
    *
    *   @var string
    */
    protected string $timezone = '';
    
    /**
    *   default_datetime_fqn
    *
    *   @var string
    */
    protected string $default_datetime_fqn = '';
    
    /**
    *   datetime_format
    *
    *   @var string
    */
    protected string $datetime_format = '';
    
    /**
    *   date_format
    *
    *   @var string
    */
    protected string $datetime_format = '';
    
    /**
    *   date_format
    *
    *   @var string
    */
    protected string $month_format = '';
    
    /**
    *   fiscal_year_format
    *
    *   @var string
    */
    protected string $fiscal_year_format = '';
    
    /**
    *   fromConfigArray
    *
    *   @param array $format_dataset
    */
    public function fromConfigArray(
        array $config = []
    ) {
        foreach ($config as $key => $val) {
            if (is_array($val)) {
                $this->fromConfigArray($val)
            }
            
            if (isset($this->$key)
            
            
        }
    }
}
