<?php

declare(strict_types=1);

namespace Concerto\test\sql\paginator;

use Concerto\test\ConcertoTestCase;
use Concerto\sql\paginator\ArrayPaginator;

class ArrayPaginatorTest extends ConcertoTestCase
{
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
        
        $obj = new ArrayPaginator($data, $pageSize);
        $extractClass = $obj->paginate($pageNo);
        $this->assertSame($expectData, $extractClass->data());
        $this->assertEquals($expectTotal, $extractClass->total());
        $this->assertEquals($expectCurrentPage, $extractClass->currentPage());
        $this->assertEquals($expectPageSize, $extractClass->pageSize());
        $this->assertEquals($expectLastPage, $extractClass->lastPage());
    }
}
