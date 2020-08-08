<?php

/**
*   BusinessDateFactory
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

class BusinessDateFactory
{
    /**
    *   timezone
    *
    *   @var DateTimeZone|string
    */
    protected $timezone = '';
    
    /**
    *   datetime_fqn
    *
    *   @var string
    */
    protected string $datetime_fqn = '';
    
    /**
    *   datetime_create_format
    *
    *   @var string
    */
    protected string $datetime_create_format = '';
    
    /**
    *   date_create_format
    *
    *   @var string
    */
    protected string $date_create_format = '';
    
    /**
    *   month_create_format
    *
    *   @var string
    */
    protected string $month_create_format = '';
    
    /**
    *   fiscal_year_create_format
    *
    *   @var string
    */
    protected string $fiscal_year_create_format = '';
    
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
        
        if (is_string($this->timezone)) {
            $this->timezone = new DateTimeZone($this->timezone); 
        }
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
        return new $this->datetime_fqn(
            "!{$this->datetime_format}",
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
        return new $this->datetime_fqn(
            "!{$this->month_format}"
        );
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
