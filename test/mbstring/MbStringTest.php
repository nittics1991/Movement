<?php

declare(strict_types=1);

namespace Concerto\test\mbstring;

use Concerto\test\ConcertoTestCase;
use Concerto\mbstring\MbString;

class MbStringTest extends ConcertoTestCase
{
    public function data5cProvider()
    {
        return [
            ['―'], ['ソ'], ['Ы'], ['Ⅸ'], ['噂'], ['浬'], ['欺'], ['圭']
            , ['構'], ['蚕'], ['十'], ['申'], ['曾'], ['箪'], ['貼'], ['能']
            , ['表'], ['暴'], ['予'], ['禄'], ['兔'], ['喀'], ['媾'], ['彌']
            , ['拿'], ['杤'], ['歃'], ['濬'], ['畚'], ['秉'], ['綵'], ['臀']
            , ['藹'], ['觸'], ['軆'], ['鐔'], ['饅'], ['鷭'], ['偆'], ['砡']
        ];
    }
    
    /**
    *   is5c
    *
    *   @test
    *   @dataProvider data5cProvider
    */
    public function is5cSucess($expect)
    {
//      $this->markTestIncomplete();
        $this->assertEquals(true, MbString::is5c($expect));
    }
    
    /**
    *   escape5c
    *
    *   @test
    *   @dataProvider data5cProvider
    */
    public function escape5cSucess($expect)
    {
//      $this->markTestIncomplete();
        
        $this->assertEquals($expect . '\\', MbString::escape5c($expect));
    }
    
    /**
    *   escape5c
    *
    *   @test
    *   @dataProvider data5cProvider
    */
    public function escape5cFalse($expect)
    {
//      $this->markTestIncomplete();
        
        //エスケープ実施しないので入力と出力が同じ
        $expect = 'あ';
        $this->assertEquals($expect, MbString::escape5c($expect));
    }
    
    /**
    *   mb_expode
    *
    *   @test
    **/
    public function mbExplode()
    {
//      $this->markTestIncomplete();
        
        $data = '1漢字2文字英字4数字数';
        $except = array('1漢', '2文', '英', '4数', '数');
        $this->assertEquals($except, MbString::explode('字', $data));
        
        $data = '1漢字2文字英字4数字数';
        $except = array('1漢', '2文', '英字4数字数');
        $this->assertEquals($except, MbString::explode('字', $data, 3));
        
        
        $data = mb_convert_encoding('1漢字2文字英字4数字数', 'SJIS', 'UTF8');
        $except = array(
            mb_convert_encoding('1漢', 'SJIS', 'UTF8'),
            mb_convert_encoding('2文', 'SJIS', 'UTF8'),
            mb_convert_encoding('英字4数字数', 'SJIS', 'UTF8')
        );
        
        $del = mb_convert_encoding('字', 'SJIS', 'UTF8');
        $this->assertEquals($except, MbString::explode($del, $data, 3, 'SJIS'));
    }
    
    /**
    *   mb_split
    *
    *   @test
    **/
    public function mb_split()
    {
//      $this->markTestIncomplete();
        
        $data = 'あいうえおかきくけこ';
        $except = array('あいう', 'えおか', 'きくけ', 'こ');
        $this->assertEquals($except, MbString::split($data, 3));
        
        $data = mb_convert_encoding($data, 'SJIS', 'UTF8');
        array_walk($except, function (&$val, $key) {
            $val = mb_convert_encoding($val, 'SJIS', 'UTF8');
        });
        $this->assertEquals($except, MbString::split($data, 3, 'SJIS'));
    }
    
    /**
    *   mb_trim
    *
    *   @test
    **/
    public function mb_trim()
    {
//      $this->markTestIncomplete();
        
        $data = "　あい う  え
            おかきくけこ 
        ";
        
        $except = "あい う  え
            おかきくけこ";
        
        $this->assertEquals($except, MbString::trim($data));
        
        $data = mb_convert_encoding($data, 'SJIS', 'UTF8');
        $except = mb_convert_encoding($except, 'SJIS', 'UTF8');
        $this->assertEquals($except, MbString::trim($data, null, 'SJIS'));
    }
    
    /**
    *   mb_replace
    *
    *   @test
    **/
    public function mb_replace()
    {
//      $this->markTestIncomplete();
        
        $data = 'あいうあいいあいういあう';
        $search = 'あい';
        $rep = 'さた';
        $except = 'さたうさたいさたういあう';
        $this->assertEquals($except, MbString::replace($search, $rep, $data));
        
        $data = mb_convert_encoding($data, 'SJIS', 'UTF8');
        $search = mb_convert_encoding($search, 'SJIS', 'UTF8');
        $rep = mb_convert_encoding($rep, 'SJIS', 'UTF8');
        $except = mb_convert_encoding($except, 'SJIS', 'UTF8');
        $this->assertEquals($except, MbString::replace($search, $rep, $data, 'SJIS'));
        
        $data = 'あいう\\あい\\いあいう\\\\いあう';
        $search = '\\';
        $rep = 'Z';
        $except = 'あいうZあいZいあいうZZいあう';
        $this->assertEquals($except, MbString::replace($search, $rep, $data));
        
        $data = 'あいう\\あい\\いあいう\\\\いあう';
        $search = '\\';
        $rep = '\\\\';
        $except = 'あいう\\\\あい\\\\いあいう\\\\\\\\いあう';
        $this->assertEquals($except, MbString::replace($search, $rep, $data));
    }
    
    /**
    *   strToArray
    *
    *   @test
    **/
    public function strToArray()
    {
//      $this->markTestIncomplete();
        
        $data = '1漢字を2使った33文字列4';
        $except = array('1', '漢', '字', 'を', '2', '使', 'っ', 'た', '3', '3', '文', '字', '列', '4');
        $this->assertEquals($except, MbString::strToArray($data));
        
        $data = mb_convert_encoding($data, 'SJIS', 'UTF8');
        array_walk($except, function (&$val, $key) {
            $val = mb_convert_encoding($val, 'SJIS', 'UTF8');
        });
        $this->assertEquals($except, MbString::strToArray($data, 'SJIS'));
    }
    
    /**
    *   splice
    *
    *   @test
    **/
    public function splice()
    {
//      $this->markTestIncomplete();
        
        $data = 'あいうえおかきくけこ';
        $this->assertEquals('あいう', MbString::splice($data, 3));
        
        $this->assertEquals('あいうきくけこ', MbString::splice($data, 3, 3));
        
        $this->assertEquals('あいうえおけこ', MbString::splice($data, -5, 3));
        
        $this->assertEquals('あいうえお漢字けこ', MbString::splice($data, -5, 3, '漢字'));
        
        $data = mb_convert_encoding($data, 'SJIS', 'UTF8');
        $rep = mb_convert_encoding('漢字', 'SJIS', 'UTF8');
        $except = mb_convert_encoding('あいうえお漢字けこ', 'SJIS', 'UTF8');
        $this->assertEquals($except, MbString::splice($data, -5, 3, $rep, 'SJIS'));
    }
    
    /**
    *   eregMatchAll
    *
    *   @test
    **/
    public function eregMatchAll()
    {
//      $this->markTestIncomplete();
        
        $string = 'あいうえおあいおいあいおあう';
        $expect = array(
            array('あい'),
            array('あい'),
            array('あい')
        );
        $this->assertEquals($expect, MbString::eregMatchAll('あい', $string));
        
        $expect = array(
            array('あい', 'あい'),
            array('あい', 'あい'),
            array('あい', 'あい')
        );
        $this->assertEquals($expect, MbString::eregMatchAll('(あい)', $string));
        
        $expect = array(
            array('あい', 'あ', 'い'),
            array('あい', 'あ', 'い'),
            array('あい', 'あ', 'い')
        );
        $this->assertEquals($expect, MbString::eregMatchAll('(あ)(い)', $string));
    }
    
    /**
    *   validEncodeName
    *
    *   @test
    **/
    public function validEncodeName()
    {
//      $this->markTestIncomplete();
        
        $this->assertEquals(true, MbString::validEncodeName('UTF-8'));
    }
    
    /**
    *   insert
    *
    *   @test
    **/
    public function insert()
    {
//      $this->markTestIncomplete();
        
        $target = '漢字123すうじ#';
        
        $string = 'Abc';
        $this->assertEquals('漢字123Abcすうじ#', MbString::insert($target, 5, $string));
        
        $string = 'Abc';
        $this->assertEquals('漢字12Abc3すうじ#', MbString::insert($target, -5, $string));
    }
    
    /**
    *   delete
    *
    *   @test
    **/
    public function delete()
    {
//      $this->markTestIncomplete();
        
        $target = '漢字123すうじ#';
        $this->assertEquals('漢字123じ#', MbString::delete($target, 5, 2));
        $this->assertEquals('漢3すうじ#', MbString::delete($target, 1, 3));
    }
    
    /**
    *   @test
    **/
    public function tab2spaceException2()
    {
//      $this->markTestIncomplete();
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('required integer >0');
        $str = 'abc def';
        $len = -4;
        
        $actual = MbString::tab2space($str, $len);
    }
    
    public function tab2spaceProvidor()
    {
        return [
            [
                'a  de  hij lmn',
                4,
                null,
                'a  de  hij lmn'
            ],
            [
                '   お   けこ  しすせ たちつて    ',
                4,
                null,
                '   お   けこ  しすせ たちつて    '
            ],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider tab2spaceProvidor
    **/
    public function tab2space($data, $tab, $encode, $expect)
    {
//      $this->markTestIncomplete();
        
        $this->assertEquals($expect, MbString::tab2space($data, $tab, $encode));
    }
    
    public function toSnakeProvider()
    {
        return [
            [
                'MstBumonData',
                'mst_bumon_data',
            ],
            [
                '_mst_Bumon_data',
                '_mst__bumon_data', //unsder scoreはそのまま残る
            ],
            [
                'mstBumon_Data',
                'mst_bumon__data',  //_Data ==> __dataとなる
            ],
            [
                '_Mst_bumonData_',
                '__mst_bumon_data_',
            ],
            [
                'MstBumonDatA',
                'mst_bumon_dat_a',
            ],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider toSnakeProvider
    **/
    public function toSnake($data, $expect)
    {
//      $this->markTestIncomplete();
        
        $this->assertEquals($expect, MbString::toSnake($data));
    }
    
    public function toUpperCamelProvider()
    {
        return [
            [
                'mst_bumon_data',
                'MstBumonData',
            ],
            [
                'mstBumon_Data',
                'MstBumonData',
            ],
            [
                'MstBumonDatA',
                'MstBumonDatA',
            ],
            [
                '_mst_bumon_data',
                'MstBumonData',
            ],
            [
                'mst_bumon_data_',
                'MstBumonData',
            ],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider toUpperCamelProvider
    **/
    public function toUpperCamel($data, $expect)
    {
//      $this->markTestIncomplete();
        
        $this->assertEquals($expect, MbString::toUpperCamel($data));
    }
    
    public function toLowerCamelProvider()
    {
        return [
            [
                'mst_bumon_data',
                'mstBumonData',
            ],
            [
                'mstBumon_Data',
                'mstBumonData',
            ],
            [
                'MstBumonDatA',
                'mstBumonDatA',
            ],
            [
                '_mst_bumon_data',
                'mstBumonData',
            ],
            [
                'mst_bumon_data_',
                'mstBumonData',
            ],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider toLowerCamelProvider
    **/
    public function toLowerCamel($data, $expect)
    {
//      $this->markTestIncomplete();
        
        $this->assertEquals($expect, MbString::toLowerCamel($data));
    }
}
