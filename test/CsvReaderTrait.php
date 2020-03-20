<?php

/**
*   CsvReaderTrait
*
*   @ver 200320
*/

declare(strict_types=1);

namespace Concerto\test;

use RuntimeException;
use SplFileObject;

trait CsvReaderTrait
{
    /**
    *   CSVファイル読込み
    *
    *   @param string $fileName
    *   @return array
    *   @info 1行目header 連想配列を作る
    */
    public function readCsvFile(string $fileName): array
    {
        $file = new SplFileObject($fileName);
        $file->setCsvControl(',');
        return $this->fileToArray($file);
    }
    
    /**
    *   TSVファイル読込み
    *
    *   @param string $fileName
    *   @return array
    *   @info 1行目header 連想配列を作る
    */
    public function readTsvFile(string $fileName): array
    {
        $file = new SplFileObject($fileName);
        $file->setCsvControl("\t");
        return $this->fileToArray($file);
    }
    
    /**
    *   配列変換
    *
    *   @param SplFileObject $splFileObject
    *   @return array
    */
    protected function fileToArray(SplFileObject $splFileObject): array
    {
        $result = [];
        $header = [];
        $haveFineshedFirst = false;
        
        $splFileObject->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY
        );
        
        foreach($splFileObject as $row) {
            if ($row === false) {
                throw new RuntimeException(
                    "file read error:" . $splFileObject->getFilename()
                );
            }
            
            if (!$haveFineshedFirst) {
                $header = $row;
                $haveFineshedFirst = true;
                continue;
            }
            
            //空行除外
            //DROP_NEW_LINEではセル改行が読めない為
            if (!isset($row[0])) {
                continue;
            }
            
            $result[] = array_combine($header, $row);
        }
        return $result;
    }
}
