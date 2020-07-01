<?php

/**
*   ValidatorException
*
*   @version 200701
*/

declare(strict_types=1);

namespace Movement\validator;

use Exception;
use InvalidArgumentException;

class ValidatorException extends Exception
{
    /**
    *   rule
    *
    *   @var string|object
    */
    protected $rule;
    
    /**
    *   value
    *
    *   @var mixed
    */
    protected $value;
    
    /**
    *   parameters
    *
    *   @var array
    */
    protected array $parameters = [];
    
    /**
    *   {inherit}
    *
    *   @param string|object $rule
    *   @param mixed $value
    *   @param array $parameters = []
    *   @param string $message
    *   @param int $code
    *   @param ?Throwable $previous
    */
    public function __construct(
        $rule,
        $value,
        array $parameters = [],
        string $message = '',
        int $code = 0,
        ?Throwable $previous
    ) {
        $this->rule = $rule;
        $this->value = $value;
        $this->parameters = $parameters;
        parent::__construct($message, $code, $previous);
    }
    
    /**
    *   getValue
    *
    *   @return mixed
    */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
    *   getParameters
    *
    *   @return array
    */
    public function getParameters(): array
    {
        return $this->parameters;
    }
    
    /**
    *   hasParameter
    *
    *   @param string $name
    *   @return array
    */
    public function hasParameter(string $name)
    {
        return isset($this->parameters[$name]);
    }
    
    /**
    *   getParameter
    *
    *   @param string $name
    *   @return array
    */
    public function getParameter(string $name)
    {
        if (!$this->has($name)) {
            throw new InvalidArgumentException(
                "not has parameter:{$name}"
            );
        }
        return $this->parameters[$name];
    }
    
    /**
    *   setMessage
    *
    *   @param string $message
    *   @return static
    */
    public function setMessage(string $message)
    {
        return new static(
            $this->getValue(),
            $this->getParameters(),
            $message,
            (int)$this->getCode(),
            $this->getPrevious(),
        );
    }
}
