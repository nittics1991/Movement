<?php

return [
    'timezone' => date_default_timezone_get(),
    'default_datetime_fqn' => DateTimeImmutable::class,
    'format' => [
        'datetime_format' => 'Ymd His',
        'date_format' => 'Ymd',
        'month_format' => 'Ym',
        'fiscal_year_format' => 'YF',
        'Quarter_format' => 'YQp',
    ],
    'start_month' => 4,
];
