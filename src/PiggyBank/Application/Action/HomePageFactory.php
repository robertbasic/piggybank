<?php

declare(strict_types=1);

namespace PiggyBank\Application\Action;

use Psr\Container\ContainerInterface;
use PiggyBank\Infrastructure\Repository\PiggyBank;

class HomePageFactory
{
    public function __invoke(ContainerInterface $container) : HomePage
    {
        $router = $container->get('router');
        $template = $container->get('template');

        $repository = $container->get(PiggyBank::class);

        return new HomePage($router, $template, $repository);
    }
}
