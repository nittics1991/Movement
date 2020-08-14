<?php

/**
*   ArrayTableInformationInterface
*
*   @version 200810
*/

declare(strict_types=1);

namespace Movement\arrays\arraytable;

use Countable;
use IteratorAggregate;

interface ArrayTableInformationInterface extends
    Countable,
    IteratorAggregate
{
    /**
    *   columnNames
    *
    *   @return string[]
    */
    public function columnNames():array;
    
    /**
    *   {inherit}
    *
    */
    public function count():int;
    
    /**
    *   {inherit}
    *
    */
    public function getIterator();
}
