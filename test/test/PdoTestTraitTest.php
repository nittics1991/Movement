<?php

declare(strict_types=1);

namespace Concerto\test;

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
        
        
        
        
    }
}
