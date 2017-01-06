<?php

declare(strict_types=1);

namespace PiggyBank\Application\Action;

use Interop\Container\ContainerInterface;
use PiggyBank\Application\Service\Deposit as DepositService;

class DepositFactory
{
    public function __invoke(ContainerInterface $container) : Deposit
    {
        $router = $container->get('router');
        $template = $container->get('template');

        $depositService = $container->get(DepositService::class);

        return new Deposit($router, $template, $depositService);
    }
}

