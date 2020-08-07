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
    //format ruleを外部定義inject
    //fqlも？
    //Configから必要事項をinject？
    
    
    
    /**
    *   base_datetime_fqn
    *
    *   @var string
    */
    protected string $base_datetime_fqn;
    
    /**
    *   __construct
    *
    *   @param ?string $base_datetime_fqn
    */
    public function __construct(
        ?string $base_datetime_fqn
    ) {
        $this->base_datetime_fqn = $base_datetime_fqn??
             DateTimeImmutable::class;
    }
    
    /**
    *   now
    * 
    *   @return DateTimeInterface
    */
    public function now(): DateTimeInterface
    {
        return new $this->base_datetime_fqn();
    }
    
    /**
    *   today
    * 
    *   @return DateTimeInterface
    */
    public function today(): DateTimeInterface
    {
        return new $this->base_datetime_fqn('!Ymd');
    }
    
    /**
    *   thisMohth
    * 
    *   @return DateTimeInterface
    */
    public function thisMohth(): DateTimeInterface
    {
        return new $this->base_datetime_fqn('!Ym');
    }
    
    /**
    *   thisFiscalYear
    * 
    *   @return DateTimeInterface
    */
    public function thisFiscalYear(): DateTimeInterface
    {
        $this_month = date('m');
        
        
        
        
        return new $this->base_datetime_fqn('!Ym');
    }
    
    
    
    
    
    
    
    
    
}
