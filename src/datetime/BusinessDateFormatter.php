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
use Movement\datetime\BusinessDateAttributeTrait;

class BusinessDateFormatter
{
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
    protected string $date_format = '';
    
    /**
    *   month_format
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
    *   start_month
    *
    *   @var int
    */
    protected int $start_month = 4;
    
    /**
    *   __construct
    *
    *   @param array $config
    */
    public function __construct(
        array $config
    ) {
        $this->fromConfigArray($config);
    }
    /**
    *   fromConfigArray
    *
    *   @param array $format_dataset
    */
    protected function fromConfigArray(
        array $config = []
    ) {
        foreach ($config as $key => $val) {
            if (is_array($val)) {
                $this->fromConfigArray($val);
            }
            
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
    }
    
    
    
    
    
    
}
