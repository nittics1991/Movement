<?php

/**
*   FiscalYearTrait
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

trait FiscalYearTrait
{
    use BusinessDateAttributeTrait;
    
    
    /**
    *   thisFiscalYear
    *
    *   @param string $code
    *   @return DateTimeInterface
    */
    public function createFromFiscalYearFormat(
        string $code
    ): DateTimeInterface {
        
        書式 FをどうやってK/Sにするか？
        
        
        $datetime = $this->datetime_fqn::createFromFormat(
            
            
        )
        
        
        
        
        $year = mb_substr($code, 0, 4);
        
        
        
    }
    
    
    
    
    
    
    
    
    
}
