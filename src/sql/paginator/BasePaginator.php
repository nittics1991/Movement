<?php

/**
*   Base Paginator
*
*   @ver 200307
**/

declare(strict_types=1);

namespace Concerto\sql\paginator;

use InvalidArgumentException;
use Concerto\mbstring\MbString;
use Concerto\sql\paginator\PaginatorInterface;

abstract class BasePaginator implements PaginatorInterface
{
    /**
    *   schema
    *
    *   @var array
    */
    protected $schema = [
        'total', 'page_size', 'current_page', 'last_page', 'data',
    ];
    
    /**
    *   container
    *
    *   @var array
    */
    protected $container = [];
    
    /**
    *   iterate
    *
    *   @var iterable
    */
    protected $iterate;
    
    /**
    *   __construct
    *
    *   @param iterate $iterate
    *   @param int $pageSize
    */
    public function __construct(
        iterable $iterate,
        int $pageSize
    ) {
        $this->iterate = $iterate;
        $this->container['page_size'] = $pageSize;
        $this->container['total'] = 0;
        $this->container['current_page'] = 0;
        $this->container['last_page'] = 0;
        $this->container['data'] = [];
    }

    /**
    *   {inherit}
    *
    */
    abstract public function paginate(int $pageNo);
    
    /**
    *   toArray
    *
    *   @return array
    */
    public function toArray(): array
    {
        return $this->container;
    }
    
    /**
    *   {inherit}
    *
   */
    public function __call(string $name, array $arguments)
    {
        $resolved = $this->resolveName($name);
        if (in_array($resolved, $this->schema)) {
            return $this->container[$resolved];
        }
        throw new InvalidArgumentException(
            "not defined:{$name}"
        );
    }
    
    /**
    *   resolveName
    *
   *    @param string $name
   *    @return string
   */
    protected function resolveName(string $name): string
    {
        return MbString::toSnake($name);
    }
}
