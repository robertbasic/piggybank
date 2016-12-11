<?php

declare(strict_types=1);

use Zend\Expressive\Router\FastRouteRouter;

use PiggyBank\Application\Action\HomePage;
use PiggyBank\Application\Action\HomePageFactory;
use PiggyBank\Application\Action\Deposit;
use PiggyBank\Application\Action\DepositFactory;

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
