<?php

/**
*   ArrayTableInterface
*
*   @version 200810
*/

declare(strict_types=1);

namespace Movement\arrays\arraytable;

use Movement\arrays\arraytable{
    ArraTableCommandInterface,
    ArraTableInformationInterface,
    ArraTableOutputInterface
};

interface ArrayTableInterface extends
    ArraTableCommandInterface,
    ArraTableInformationInterface,
    ArraTableOutputInterface
{
}
