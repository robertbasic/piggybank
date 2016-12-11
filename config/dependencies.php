<?php

declare(strict_types=1);

use Zend\Db\Adapter\AdapterServiceFactory;

use PiggyBank\Infrastructure\Repository;

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
