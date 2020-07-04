<?php

declare(strict_types=1);

namespace Movement\test\container\directory\child;

class ChildProviderTarget2
{
    public function __invoke()
    {
        return __CLASS__;
    }
}
