<?php

declare(strict_types=1);

namespace Movement\test\container;

use Movement\container\provider\AbstractServiceProvider;
use Movement\container\provider\BootableServiceProviderInterface;

class TestServiceProvider31 extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected $provides = [
      \PDO::class
    ];
    
    public function register()
    {
    }
    
    public function boot()
    {
        $ar = new \ArrayObject($this->getContainer()->get('array.data'));
        $this->share(\ArrayObject::class, $ar);
    }
}
