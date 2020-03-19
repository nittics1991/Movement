<?php

/**
*   CsvReaderTrait
*
*   @ver 200320
*/

declare(strict_types=1);

namespace Concerto\test;

//use InvalidArgumentException;
//use ReflectionClass;
//use ReflectionMethod;
//use ReflectionProperty;

trait CsvReaderTrait
{
    /**
    *   CSVファイル読込み
    *
    *   @param string $fileName
    *   @return array
    */
    public function readCsvFile(string $fileName): array
    {
        $file = new SplFileObject($fileName);
        $file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
        );
        
        $result = [];
        $header = [];
        
        
        
        
        
        
        
    }
    
    
    
    
    
    
}
