<?php

declare(strict_types=1);

namespace Concerto\test\sql\paginator;

use PDO;
use Concerto\test\ConcertoTestCase;
use Concerto\test\PdoTestTrait;
use Concerto\sql\paginator\PdoStatementPaginator;

class PDOStatementPaginatorTest extends ConcertoTestCase
{
    use PdoTestTrait;
    
    public function paginateProvider()
    {
        $data = $this->readCsvFile(
            realpath(__DIR__ . '/data/data1.csv')
        );
        
        return [
            [
                $data,
                2,
                2,
                array_slice($data, 2, 2),
                5,
                2,
                2,
                3,
            ],//
            [
                array_slice($data, 0, 4),
                3,
                1,
                array_slice($data, 0, 3),
                4,
                1,
                3,
                2,
            ],//
        ];
    }
    
    /**
    *  @test
    *  @dataProvider paginateProvider
    */
    public function paginate(
        array $data,
        int $pageSize,
        int $pageNo,
        array $expectData,
        int $expectTotal,
        int $expectCurrentPage,
        int $expectPageSize,
        int $expectLastPage
    ) {
        
        $pdo = $this->createPdoFromArray($data, 'test_table');
        
        $sql = "SELECT * FROM test_table";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        
        $obj = new PdoStatementPaginator($stmt, $pageSize);
        $extractClass = $obj->paginate($pageNo);
        $this->assertSame($expectData, $extractClass->data());
        $this->assertEquals($expectTotal, $extractClass->total());
        $this->assertEquals($expectCurrentPage, $extractClass->currentPage());
        $this->assertEquals($expectPageSize, $extractClass->pageSize());
        $this->assertEquals($expectLastPage, $extractClass->lastPage());
    }
}
