<?php

/**
*   BusinessDateFormatter
*
*   @version 200802
*/

declare(strict_types=1);

namespace Movement\datetime;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use DatePeriod;

class BusinessDateFormatter
{
    /**
    *   datetime_format
    *
    *   @var string
    */
    protected string $datetime_format = 'Ymd His';
    
    /**
    *   date_format
    *
    *   @var string
    */
    protected string $datetime_format = 'Ymd';
    
    /**
    *   date_format
    *
    *   @var string
    */
    protected string $month_format = 'Ym';
    
    /**
    *   fiscal_year_format
    *
    *   @var string
    */
    protected string $fiscal_year_format = 'F';
    
    /**
    *   __construct
    *
    *   @param array $format_dataset
    */
    public function __construct(
        array $format_dataset = []
    ) {
        $this->fromArray($format_dataset);
    }
    
    /**
    *   {inherit}
    */
    public function __call(
        string $name,
        array $arguments
    ) {
        
        
        
        if (mb_ereg_match('', $name) {
            
            
            $method_name = $this->snakeToCamelCase($name)
            if (method_exists($this, $method_name)) {
                
            }
            
        }
      
        
        
        
    }
    
    
    
    
    
    
    
    
    
}
