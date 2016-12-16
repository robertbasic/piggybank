<?php

declare(strict_types=1);

namespace PiggyBank\Application\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomePage
{
    private $router;

    private $template;

    public function __construct(RouterInterface $router, TemplateRendererInterface $template)
    {
        $this->router = $router;
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next) : HtmlResponse
    {
        $variables = [];

        $template = $this->template->render('piggybank::home-page', $variables);

        return new HtmlResponse($template);
    }
}
