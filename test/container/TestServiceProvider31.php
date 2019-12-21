<?php

declare(strict_types=1);

namespace Concerto\test\container;

use Concerto\container\provider\AbstractServiceProvider;
use Concerto\container\provider\BootableServiceProviderInterface;

class TestServiceProvider31 extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected $provides = [
      \ArrayObject::class
    ];
    
    public function register()
    {
    }
    
    public function boot()
    {
        $pdo = new \ArrayObject($this->getContainer()->get('array.data'));
        $this->share(\ArrayObject::class, $pdo);
    }
}
