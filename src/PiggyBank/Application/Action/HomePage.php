<?php

declare(strict_types=1);

namespace PiggyBank\Application\Action;

use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomePage
{
    public function __construct(RouterInterface $router, TemplateRendererInterface $template)
    {
        $this->router = $router;
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        $variables = [
            'name' => 'Robert',
        ];

        $template = $this->template->render('piggybank::home-page', $variables);

        return new HtmlResponse($template);
    }
}
