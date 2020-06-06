<?php

/**
*   InitializePropertyTrait
*
*   @version 200516
*/

declare(strict_types=1);

namespace Movement\accessor;

trait InitializePropertyTrait
{
    /**
    *   プロパティ初期化
    *
    *   @param array $data
    *   @param array $init
    *   @return $this
    */
    protected function initializeProperties(
        array $data,
        array $init = []
    ) {
        $this->importExceptUndefinedProperties($this->properties);
        $this->importExceptUndefinedProperties($init);
        $this->importExceptUndefinedProperties($data);
        return $this;
    }
    
    /**
    *   未定義のpropertyデータを無視してfromArray
    *
    *   @param array $data
    *   @return $this
    */
    protected function importExceptUndefinedProperties(array $data)
    {
        if (!isset($this->properties)) {
            $this->reflecteProperty();
        }
        
        return $this->fromArray(
            array_intersect_key(
                $data,
                $this->properties
            )
        );
    }
}
