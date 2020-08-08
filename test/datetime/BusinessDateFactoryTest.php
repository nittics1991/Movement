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
            'create_format' => [
                'datetime_create_format' => 'Ymd His',
                'date_create_format' => 'Ymd',
                'month_create_format' => 'Ym',
                'fiscal_year_create_format' => 'YF',
                'Quarter_create_format' => 'YQp',
            ],
            /*
            'format' => [
                'datetime_format' => 'Ymd His',
                'date_format' => 'Ymd',
                'month_format' => 'Ym',
                'fiscal_year_format' => 'YF',
                'Quarter_format' => 'YQp',
            ],
            */
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
            $expect->format(
                $this->config['create_format']['datetime_create_format']
            ),
            $obj->now()->format(
                $this->config['create_format']['datetime_create_format']
            )
        );
    }
}
