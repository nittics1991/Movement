<?php

declare(strict_types=1);

namespace Movement\test\datetime;

use Movement\test\MovementTestCase;
use Movement\datetime\BusinessDateFactory;
use DateTime;
use DateTimeImmutable;

class BusinessDateFactoryTest extends MovementTestCase
{
    public function nowメソッドdataProvider()
    {
        return[
            [
                null,
                new DateTime()
            ],
            [
                DateTime::class,
                new DateTime()
            ],
            [
                DateTimeImmutable::class,
                new DateTimeImmutable()
            ],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider nowメソッドdataProvider
    */
    public function nowメソッド(
        $fqn,
        $expect
    ) {
      //$this->markTestIncomplete();

        $obj = new BusinessDateFactory($fqn);

        $this->assertInstanceOf(
            $fqn?? DateTimeImmutable::class,
            $obj->now()
        );

        $this->assertEquals(
            $expect->format('Ymd His'),
            $obj->now()->format('Ymd His')
        );
        
        
        
        
        
    }
}
