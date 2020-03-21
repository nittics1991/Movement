<?php

declare(strict_types=1);

namespace Concerto\test;

use VirtualFileSystem\FileSystem;
use Concerto\test\CsvReaderTrait;
use Concerto\test\ConcertoTestCase;

class StubCsvReader
{
    use CsvReaderTrait;
}

/////////////////////////////////////////////////////////////////////

class CsvReaderTraitTest extends ConcertoTestCase
{
    public function setUp(): void
    {
    }
    
    public function csvReadProvider()
    {
        return [
            [
                [
                    ['aaa', 'bbb', 'ccc',],
                    ['11', "12", 13,],
                    [],
                    ['21', "2
2", 23,],
                    ['31', "3\"2", 33,],
                ],
                [
                    ['aaa' => '11', 'bbb' => '12', 'ccc' => '13',],
                    ['aaa' => '21', 'bbb' => "2
2", 'ccc' => '23',],
                    ['aaa' => '31', 'bbb' => '3"2', 'ccc' => '33',],
                ],
            ]//
        ];
    }

    /**
    *   @test
    *   @dataProvider csvReadProvider
    */
    public function csvRead($data, $actual)
    {
//      $this->markTestIncomplete();
        
        $filename = '/test.csv';
        $fs = new FileSystem();
        $fp = fopen($fs->path($filename), 'w');
                
        foreach ($data as $list) {
            fputcsv($fp, $list);
        }
        fclose($fp);
        
        $stab = new StubCsvReader();
        $expect = $stab->readCsvFile($fs->path($filename));
        
        $this->assertSame($expect, $actual);
    }

    /**
    *   @test
    *   @dataProvider csvReadProvider
    */
    public function tsvRead($data, $actual)
    {
//      $this->markTestIncomplete();
        
        $filename = '/test.csv';
        $fs = new FileSystem();
        $fp = fopen($fs->path($filename), 'w');
                
        foreach ($data as $list) {
            fputcsv($fp, $list, "\t");
        }
        fclose($fp);
        
        $stab = new StubCsvReader();
        $expect = $stab->readTsvFile($fs->path($filename));
        
        $this->assertSame($expect, $actual);
    }
}
