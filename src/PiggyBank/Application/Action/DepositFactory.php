<?php

declare(strict_types=1);

namespace PiggyBank\Application\Action;

use Interop\Container\ContainerInterface;

use PiggyBank\Infrastructure\Repository\PiggyBank;

class DepositFactory
{
    public function __invoke(ContainerInterface $container) : Deposit
    {
        $router = $container->get('router');
        $template = $container->get('template');

        $repository = $container->get(PiggyBank::class);

        return new Deposit($router, $template, $repository);
    }
}

