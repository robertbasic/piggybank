<?php

declare(strict_types=1);

use Zend\Expressive\ZendView\ZendViewRendererFactory;

return [
    'dependencies' => [
        'factories' => [
            'template' => ZendViewRendererFactory::class,
            Zend\View\HelperPluginManager::class => Zend\Expressive\ZendView\HelperPluginManagerFactory::class,
        ],
    ],
    'templates' => [
        'layout' => 'layout/piggybank',
        'map' => [
            'layout/piggybank' => 'templates/layout/piggybank.phtml'
        ],
        'paths' => [
            'piggybank' => ['templates/piggybank'],
            'layout' => ['templates/layout'],
            'error' => ['templates/error'],
        ]
    ],
    'view_helpers' => [
        'invokables' => [
            'customHelper' => 'PiggyBank\CustomHelper'
        ]
    ]
];
