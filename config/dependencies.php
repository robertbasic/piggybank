<?php

declare(strict_types=1);

use PiggyBank\Infrastructure\DatabaseConnectionFactory;
use PiggyBank\Infrastructure\Repository;
use PiggyBank\Infrastructure\Service\Deposit;
use PiggyBank\Infrastructure\Service\DepositFactory;

return [
    'dependencies' => [
        'services' => [
        ],
        'invokables' => [
        ],
        'factories' => [
            DB_CONNECTION => DatabaseConnectionFactory::class,

            Repository\PiggyBank::class => Repository\PiggyBankFactory::class,
            Deposit::class => DepositFactory::class,
        ]
    ]
];
