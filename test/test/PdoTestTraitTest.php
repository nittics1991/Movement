<?php

declare(strict_types=1);

namespace Concerto\test;

use PDO;
use Concerto\test\{
    ConcertoTestCase,
    PdoTestTrait
};

class PdoTestTraitTest extends ConcertoTestCase
{
    use PdoTestTrait;
    
    /**
    *   @test
    */
    public function buildPdo()
    {
//      $this->markTestIncomplete();
        
        $data = $this->readCsvFile(
            realpath(__DIR__ . '/data/data1.csv')
        );
        
        $pdo = $this->createPdoFromArray($data, 'test_table');
        
        $this->assertInstanceOf(PDO::class, $pdo);
        
        $sql = "SELECT * FROM test_table";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $actual = $stmt->fetchAll();
        
        $this->assertEquals(count($data), count($actual));
        
        array_map(
            function($expect_row, $actual_row) {
                $this->assertSame($expect_row, $actual_row);
            },
            $data,
            $actual
        );
    }
}
