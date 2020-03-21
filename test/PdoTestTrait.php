<?php

/**
*   PdoTestTrait
*
*   @ver 200321
*   @coution used sqlite3
*/

declare(strict_types=1);

namespace Concerto\test;

use PDO;
use InvalidArgumentException;

trait PdoTestTrait
{
    /**
    *   arrayからPDO生成
    *
    *   @param array $dataset
    *   @param string $tableName
    *   @return PDO
    */
    public function createPdoFromArray(
        array $dataset,
        string $tableName
    ): PDO {
        $pdo = new PDO('sqlite::memory:');
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        
        if (empty($dataset)) {
            throw new InvalidArgumentException(
                "empty data"
            );
        }
        
        $column_names = array_keys($dataset[0]);
        
        $sql_create = "
            CREATE TABLE {$tableName} (
        ";
        
        $sql_tmp = '';
        
        array_walk(
            $column_names,
            function ($val, $key) use (&$sql_tmp) {
                $sql_tmp .= ",{$val} TEXT";
            }
        );
        
        $sql_create .= mb_substr($sql_tmp, 1) . ')';
        
        $stmt = $pdo->prepare($sql_create);
        $stmt->execute();
        
        $sql_insert = "
            INSERT INTO  {$tableName}
        ";
        
        $sql_tmp = '';
        
        array_walk(
            $column_names,
            function ($val, $key) use (&$sql_tmp) {
                $sql_tmp .= ",{$val}";
            }
        );
        
        $sql_insert .= '('
            . mb_substr($sql_tmp, 1)
            . ') VALUES ';
        
        $sql_tmp_outer = '';
        $i = 1;
        
        foreach ($dataset as $data) {
            $sql_tmp_inner = '';
            
            foreach ($data as $val) {
                $sql_tmp_inner .= ",:{$i}";
                $i++;
            }
            $sql_tmp_outer .= ',('
                . mb_substr($sql_tmp_inner, 1)
                . ')' ;
        }
        
        $sql_insert .= ''
            . mb_substr($sql_tmp_outer, 1);
        
        
        var_dump($sql_insert);
        
        
        $stmt = $pdo->prepare($sql_insert);
        
        $i = 1;
        
        foreach ($dataset as $data) {
            foreach ($data as $val) {
                $stmt->bindValue(":{$i}", $val, PDO::PARAM_STR);
            }
            $i++;
        }
        
        $stmt->execute();
        return $pdo;
    }
}
