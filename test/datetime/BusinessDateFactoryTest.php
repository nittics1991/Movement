<?php

declare(strict_types=1);

namespace Movement\test\datetime;

use Movement\test\MovementTestCase;
use Movement\datetime\BusinessDateFactory;
use DateTime;
use DateTimeImmutable;

class BusinessDateFactoryTest extends MovementTestCase
{
    protected function setUp(): void
    {
        $this->config = [
            'timezone' => date_default_timezone_get(),
            'datetime_fqn' => DateTimeImmutable::class,
            'format' => [
                'datetime_format' => 'Ymd His',
                'date_format' => 'Ymd',
                'month_format' => 'Ym',
                'fiscal_year_format' => 'YF',
                'Quarter_format' => 'YQp',
            ],
            'start_month' => 4,
        ];
    }
    
    public function nowメソッドdataProvider()
    {
        return[
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
        
        $this->config['datetime_fqn'] = $fqn;
        
        $obj = new BusinessDateFactory($this->config);

        $this->assertInstanceOf(
            $fqn,
            $obj->now()
        );

        $this->assertEquals(
            $expect->format($this->config['format']['datetime_format']),
            $obj->now()->format($this->config['format']['datetime_format'])
        );
    }
}
