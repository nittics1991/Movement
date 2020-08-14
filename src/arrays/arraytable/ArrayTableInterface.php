<?php

/**
*   ArrayTableInterface
*
*   @version 200810
*/

declare(strict_types=1);

namespace Movement\arrays\arraytable;

use Movement\arrays\arraytable{
    ArrayTableCommandInterface,
    ArrayTableInformationInterface,
    ArrayTableOutputInterface
};

interface ArrayTableInterface extends
    ArrayTableCommandInterface,
    ArrayTableInformationInterface,
    ArrayTableOutputInterface
{
}
