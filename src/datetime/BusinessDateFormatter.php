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
    
    
    
    
    
    
    
}
