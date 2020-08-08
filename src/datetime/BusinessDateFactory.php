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
use Movement\datetime\BusinessDateAttributeTrait;

class BusinessDateFactory
{
    use BusinessDateAttributeTrait;
    
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
    *   now
    * 
    *   @return DateTimeInterface
    */
    public function now(): DateTimeInterface
    {
        return new $this->datetime_fqn();
    }
    
    /**
    *   today
    * 
    *   @return DateTimeInterface
    */
    public function today(): DateTimeInterface
    {
        return new $this->datetime_fqn(
            "!{$this->datetime_format}"
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
    
    
    
    
    
    
    
    
    
}
