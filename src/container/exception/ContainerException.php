<?php

/**
*   ContainerException
*
*   @ver 170208
**/

declare(strict_types=1);

namespace Movement\container\exception;

use Exception;
use Psr\Container\ContainerExceptionInterface;

class ContainerException extends Exception implements
    ContainerExceptionInterface
{
}
