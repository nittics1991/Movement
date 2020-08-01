<?php

declare(strict_types=1);

namespace Movement\test\accessor;

use Movement\test\MovementTestCase;
use Movement\accessor\ReflectPropertyTrait;
use PDO;

/**
*   疑似DataMapperクラス
*/
class PseudoDataMapperTestTarget
{
    use ReflectPropertyTrait{
        toArray as public;
    }
    
    public int $int_data;
    public float $float_data;
    public string $string_data;
    public DateTime $date_data;
}

////////////////////////////////////////////////////////////////////////////////

class PseudoDataMapperTest extends MovementTestCase
{
    protected $pdo;
    
    public static function setUpBeforeClass(): void
    {
        $dns = 'sqlite::memory:';
        $this->pdo = new PDO(
            $dns,
            null,
            null,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]
        );
    }
    
    /**
    *
    */
    public function 保存データ作成時メソッドdataProvider()
    {
        return [
            [
                [
                    'int_data' => 1234,
                    'float_data' => 56.78,
                    'string_data' => '9876',
                    'date_data' => '2000-09-30 12:34:56',
                ],
                
                
            ],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider 保存データ作成時メソッドdataProvider
    */
    public function 保存データ作成時メソッド(
        $data,
        $expect
    ) {
//      $this->markTestIncomplete();
        
        $obj = new PseudoDataMapperTestTarget();
        
        //$obj->
        
        
        
        
    }
}
