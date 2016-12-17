<?php

declare(strict_types=1);

namespace PiggyBank\Application\Action;

use PiggyBank\Infrastructure\Service\Deposit as DepositService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class Deposit
{
    private $router;

    private $template;

    private $deposit;

    public function __construct(RouterInterface $router, TemplateRendererInterface $template, DepositService $deposit)
    {
        $this->router = $router;
        $this->template = $template;
        $this->deposit = $deposit;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next) : ResponseInterface
    {
        $amount = $request->getParsedBody()['amount'];

        $this->deposit->deposit($amount);

        return $response->withAddedHeader('Location', '/');
    }
}
