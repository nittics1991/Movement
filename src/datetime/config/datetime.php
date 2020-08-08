<?php

return [
    'timezone' => date_default_timezone_get(),
    'datetime_fqn' => DateTimeImmutable::class,
    'create_format' => [
        'datetime_create_format' => 'Ymd His',
        'date_create_format' => 'Ymd',
        'month_create_format' => 'Ym',
        'fiscal_year_create_format' => 'YF',
        'Quarter_create_format' => 'YQp',
    ],
    'format' => [
        'datetime_format' => 'Ymd His',
        'date_format' => 'Ymd',
        'month_format' => 'Ym',
        'fiscal_year_format' => 'YF',
        'Quarter_format' => 'YQp',
    ],
    'start_month' => 4,
];
