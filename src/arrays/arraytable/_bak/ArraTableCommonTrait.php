<?php

/**
*   ArraTableCommonInterface
*
*   @version 200810
*/

declare(strict_types=1);

namespace Movement\arrays\arraytable;

trait ArraTableCommonTrait
{
    
    //ArrayTableで？
    /**
    *   transverse
    *
    *   @param array[] $dataset
    *   @return void
    */
    protected function transverse(
        array $dataset
    ) :void {
        $this->column_names = array_keys($dataset);
        
        foreach($this->column_names as $name) {
            $this->dataset[$name] = array_columns(
                $dataset,
                $name
            );
        }
    }
}
