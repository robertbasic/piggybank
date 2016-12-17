<?php

declare(strict_types=1);

use PiggyBank\Infrastructure\Repository;
use Zend\Db\Adapter\AdapterServiceFactory;

return [
    'dependencies' => [
        'services' => [
        ],
        'invokables' => [
        ],
        'factories' => [
            'DatabaseAdapter' => AdapterServiceFactory::class,

            Repository\PiggyBank::class => Repository\PiggyBankFactory::class,
        ]
    ]
];
