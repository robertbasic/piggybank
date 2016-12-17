<?php

declare(strict_types=1);

use PiggyBank\Application\Action\Deposit;
use PiggyBank\Application\Action\DepositFactory;
use PiggyBank\Application\Action\HomePage;
use PiggyBank\Application\Action\HomePageFactory;
use Zend\Expressive\Router\FastRouteRouter;

return [
    'dependencies' => [
        'services' => [
            'router' => new FastRouteRouter()
        ],
        'invokables' => [
        ],
        'factories' => [
            HomePage::class => HomePageFactory::class,
            Deposit::class => DepositFactory::class,
        ]
    ]
];
