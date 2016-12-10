<?php

declare(strict_types=1);

use Zend\Db\Adapter\AdapterServiceFactory;

return [
    'dependencies' => [
        'services' => [
        ],
        'invokables' => [
        ],
        'factories' => [
            'DatabaseAdapter' => AdapterServiceFactory::class,
        ]
    ]
];
