<?php
declare(strict_types=1);

namespace Concerto\test\sql\paginator;

use Concerto\test\ConcertoTestCase;
use Concerto\sql\paginator\ArrayPaginator;

class ArrayPaginatorTest extends ConcertoTestCase
{
    
    public function paginate1Provider()
    {
        $data = $this->readCsvFile(
            realpath(__DIR__ . '/data/data1.csv')
        );
        
        $expect[0] = array_slice($data, 2, 2);
        
        
        var_dump($expect);
        
        return [
            //[$data, 2, 2, [1]],
            [[], 1,2,[]]
        ];
    }
    
    /*
    *   @test
    *   @dataProvider paginate1Provider
    */
    public function testPagenate1(
        array $data,
        int $pageSize,
        int $pageNo,
        array $expect
    ) {
        $obj = new ArrayPaginator($data, $pageSize);
        
        
        var_dump($obj->paginate(2));
        
        
        $this->assertSame($expect, $obj->paginate(2));
        
        
        $this->paginate1Provider();
        
        
    }
    
}
