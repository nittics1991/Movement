<?php

/**
*   EmitterInterface
*
*   @ver 191222
**/

declare(strict_types=1);

namespace Concerto\http;

use Psr\Http\Message\ResponseInterface;

interface ContainerAwareInterface
{
    /**
    *   emit
    *
    * @param ResponseInterface $response
    **/
    public function emit(ResponseInterface $response);
}
