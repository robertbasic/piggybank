<?php

declare(strict_types=1);

use PiggyBank\Infrastructure\Repository;
use PiggyBank\Infrastructure\DatabaseConnectionFactory;

return [
    'dependencies' => [
        'services' => [
        ],
        'invokables' => [
        ],
        'factories' => [
            DB_CONNECTION => DatabaseConnectionFactory::class,

            Repository\PiggyBank::class => Repository\PiggyBankFactory::class,
        ]
    ]
];
