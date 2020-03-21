<?php

/**
*   LeagueRequestHandlerAdapter
*
*   @version 191222
**/

declare(strict_types=1);

namespace Concerto\http;

use League\Route\Router;
use Psr\Http\Server\{
    RequestHandlerInterface,
    ResponseInterface
};

class LeagueRequestHandlerAdapter implements RequestHandlerInterface
{
    /**
    *   router
    *
    *   @var Router
    */
    protected $router;
    
    /**
    *   __construct
    *
    */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    
    /**
    *   {inherit}
    *
    */
    public function handle(
        ServerRequestInterface $request
    ): ResponseInterface {
        return $this->router->dispatch($request);
    }
    
    /**
    *   {inherit}
    *
    */
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array(
            [$this->router, $name],
            $arguments
        );
    }
}
