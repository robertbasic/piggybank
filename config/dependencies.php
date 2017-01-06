<?php

declare(strict_types=1);

use PiggyBank\Application\Service\Deposit;
use PiggyBank\Application\Service\DepositFactory;
use PiggyBank\Infrastructure\DatabaseConnectionFactory;
use PiggyBank\Infrastructure\Repository;

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
