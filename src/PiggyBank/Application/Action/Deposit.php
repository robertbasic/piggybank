<?php

declare(strict_types=1);

namespace PiggyBank\Application\Action;

use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use PiggyBank\Domain\PiggyBank;

class Deposit
{
    public function __construct(RouterInterface $router, TemplateRendererInterface $template)
    {
        $this->router = $router;
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        $amount = $request->getParsedBody()['amount'];

        $piggyBank = new PiggyBank();

        $piggyBank->deposit($amount);

        return $response->withAddedHeader('Location', '/');
    }
}
