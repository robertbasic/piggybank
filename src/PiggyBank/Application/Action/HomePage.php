<?php

declare(strict_types=1);

namespace PiggyBank\Application\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use PiggyBank\Infrastructure\Repository\PiggyBank;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomePage implements MiddlewareInterface
{
    private $router;

    private $template;

    private $repository;

    public function __construct(RouterInterface $router, TemplateRendererInterface $template, PiggyBank $repository)
    {
        $this->router = $router;
        $this->template = $template;
        $this->repository = $repository;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate) : HtmlResponse
    {
        $flash = $request->getAttribute('flash');

        $currentAmount = $this->repository->getCurrentAmount();

        $variables = [
            'currentAmount' => $currentAmount,
            'messages' => $flash->getMessages()
        ];

        $template = $this->template->render('piggybank::home-page', $variables);

        return new HtmlResponse($template);
    }
}
