<?php

/**
*   InputValueObjectFactory
*
*   @version 200628
*/

declare(strict_types=1);

namespace Movement\standard;

use Psr\Http\Message\RequestInterface;
use Movement\standard\InputValueObject;

class InputValueObjectFactory
{
    /**
    *   buildQuery
    *
    *   @param string $class_name
    *   @param ?RequestInterface $request
    *   @return InputValueObject
    */
    public function buildQuery(
        string $class_name,
        ?RequestInterface $request
    ): InputValueObject {
        if (!class_exists($class_name)) {
            throw new InvalidArgumentException(
                "not defined class:{$class_name}"
            );
        }
        
        return new $class_name(
            isset($request)?
            $request->getQueryParams():
            $_QUERY;
        );
    }
    
    /**
    *   buildPost
    *
    *   @param string $class_name
    *   @param ?RequestInterface $request
    *   @return InputValueObject
    */
    public function buildPost(
        string $class_name,
        ?RequestInterface $request
    ): InputValueObject {
        if (!class_exists($class_name)) {
            throw new InvalidArgumentException(
                "not defined class:{$class_name}"
            );
        }
        
        return new $class_name(
            isset($request)?
            $request->getParsedBody():
            $_POST;
        );
    }
}
