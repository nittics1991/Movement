<?php

declare(strict_types=1);

namespace Concerto\test\mbstring;

use Concerto\test\ConcertoTestCase;
use Concerto\mbstring\MbConvert;

class MbConvertTest extends ConcertoTestCase
{
    public function roma2kanaProvider()
    {
        return [
            ['aiueo', 'あいうえお'],
            ['kakikukeko', 'かきくけこ'],
            ['sasisuseso', 'さしすせそ'],
            ['tatituteto', 'たちつてと'],
            ['naninuneno', 'なにぬねの'],
            ['hahihuheho', 'はひふへほ'],
            ['mamimumemo', 'まみむめも'],
            ['yayuyo', 'やゆよ'],
            ['rarirurero', 'らりるれろ'],
            ['wawonn', 'わをん'],
            
            ['gagigugego', 'がぎぐげご'],
            ['zazizuzezo', 'ざじずぜぞ'],
            ['dadidudedo', 'だぢづでど'],
            ['babibubebo', 'ばびぶべぼ'],
            ['papipupepo', 'ぱぴぷぺぽ'],
            
            ['kyakyikyukyekyo', 'きゃきぃきゅきぇきょ'],
            
            ['syasyisyusyesyo', 'しゃしぃしゅしぇしょ'],
            ['shashishushesho', 'しゃししゅしぇしょ'],
            
            ['tyatyityutyetyo', 'ちゃちぃちゅちぇちょ'],
            ['thathithuthetho', 'てゃてぃてゅてぇてょ'],
            ['tsatsitsutsetso', 'つぁつぃつつぇつぉ'],
            
            ['nyanyinyunyenyo', 'にゃにぃにゅにぇにょ'],
            
            ['hyahyihyuhyehyo', 'ひゃひぃひゅひぇひょ'],
            
            ['myamyimyumyemyo', 'みゃみぃみゅみぇみょ'],
            
            ['ryaryiryuryeryo', 'りゃりぃりゅりぇりょ'],
            
            ['wawiwuwewo', 'わうぃううぇを'],
            
            ['gyagyigyugyegyo', 'ぎゃぎぃぎゅぎぇぎょ'],
            
            ['zyazyizyuzyezyo', 'じゃじぃじゅじぇじょ'],
            
            ['dyadyidyudyedyo', 'ぢゃぢぃぢゅぢぇぢょ'],
            
            ['byabyibyubyebyo', 'びゃびぃびゅびぇびょ'],
            
            ['pyapyipyupyepyo', 'ぴゃぴぃぴゅぴぇぴょ'],
            
            ['cacicuceco', 'かしくせこ'],
            ['cyacyicyucyecyo', 'ちゃちぃちゅちぇちょ'],
            ['chachichuchecho', 'ちゃちちゅちぇちょ'],
            
            ['fafifufefo', 'ふぁふぃふふぇふぉ'],
            ['fyafyifyufyefyo', 'ふゃふぃふゅふぇふょ'],
            
            ['jajijujejo', 'じゃじじゅじぇじょ'],
            ['jyajyijyujyejyo', 'じゃじぃじゅじぇじょ'],
            
            ['lalilulelo', 'ぁぃぅぇぉ'],
            ['lyalyilyulyelyo', 'ゃぃゅぇょ'],
            
            ['qaqiquqeqo', 'くぁくぃくくぇくぉ'],
            ['qyaqyiqyuqyeqyo', 'くゃくぃくゅくぇくょ'],

            ['vavivuvevo', 'ヴぁヴぃヴヴぇヴぉ'],
            ['vyavyivyuvyevyo', 'ヴゃヴぃヴゅヴぇヴょ'],
            
            ['xaxixuxexo', 'ぁぃぅぇぉ'],
            ['xyaxyixyuxyexyo', 'ゃぃゅぇょ'],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider roma2kanaProvider
    */
    public function roma2kana($data, $expect)
    {
//      $this->markTestIncomplete();
        
        $this->assertEquals($expect, MbConvert::roma2kana($data));
    }
}
