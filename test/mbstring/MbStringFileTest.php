<?php

declare(strict_types=1);

namespace Concerto\test\mbstring;

use \SplFileObject;
use Concerto\test\ConcertoTestCase;
use Concerto\mbstring\MbString;

class MbStringFileTest extends ConcertoTestCase
{
    private $dir;
    
    protected function setUp(): void
    {
        if (stripos($_SERVER["OS"], 'WINDOWS') === false) {
            $this->markTestSkipped('Windows上でのみテスト実行');
            return;
        }
        
         $this->dir = __DIR__ . '\\tmp';
        
        if (!file_exists($this->dir)) {
            mkdir($this->dir);
        }
    }
    
//  public static function tearDownAfterClass()
    protected function tearDown(): void
    {
        exec("del /Q {$this->dir}\\*.* ");
    }
    
    /**
    *   ファイル操作
    *
    *   @test
    */
    public function fileOperation()
    {
//      $this->markTestIncomplete();
        
        $file = "{$this->dir}\\テスト表示.txt";
        $sjis = mb_convert_encoding(MbString::escape5c($file), 'SJIS', 'UTF8');
        $expect = mb_convert_encoding($file, 'SJIS', 'UTF8');
        
        $data = mb_convert_encoding("文字列\r\n表示\r\n文字列", 'SJIS', 'UTF8');
        
        file_put_contents($sjis, $data, LOCK_EX);
        $this->assertFileExists($expect);
        
        $actual = file_get_contents($sjis);
        $this->assertEquals($data, $actual);
        
        $file2 = "{$this->dir}\\テスト予定.txt";
        $sjis2 = mb_convert_encoding(MbString::escape5c($file2), 'SJIS', 'UTF8');
        $expect2 = mb_convert_encoding($file2, 'SJIS', 'UTF8');
        
        copy($sjis, $sjis2);
        $this->assertFileExists($expect2);
        
        //renameは5c処理不要
        
        unlink($expect2);
        $this->assertFileNotExists($expect2);
        
        //mkdirは5c処理不要
        //rmdirは5c処理不要
    }
    /**
    *   SplFileObject
    *
    *   @test
    */
    public function splFileObject()
    {
//      $this->markTestIncomplete();
        
        $file = "{$this->dir}\\テスト表示.txt";
        $sjis = mb_convert_encoding(MbString::escape5c($file), 'SJIS', 'UTF8');
        $expect = mb_convert_encoding($file, 'SJIS', 'UTF8');
        
        $splFileObject = new SplFileObject($sjis, 'w');
        
        $data = mb_convert_encoding("文字列\r\n表示\r\n文字列", 'SJIS', 'UTF8');
        
        $splFileObject->fwrite($data);
        $splFileObject = null;
        $this->assertFileExists($expect);
        
        
        $splFileObject = new SplFileObject($sjis, 'r');
        
        $actual1 = $splFileObject->fgets();
        $actual2 = $splFileObject->fgets();
        $splFileObject = null;
        
        $expect1 = mb_convert_encoding("文字列\r\n", 'SJIS', 'UTF8');
        $expect2 = mb_convert_encoding("表示\r\n", 'SJIS', 'UTF8');
        
        $this->assertEquals($expect1, $actual1);
        $this->assertEquals($expect2, $actual2);
    }
}
