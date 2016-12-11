<?php

declare(strict_types=1);

namespace PiggyBank\Application\Action;

use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use PiggyBank\Domain\PiggyBank;
use PiggyBank\Infrastructure\Repository\PiggyBank as PiggyBankRepository;

class Deposit
{
    private $router;

    private $template;

    private $repository;

    public function __construct(RouterInterface $router, TemplateRendererInterface $template, PiggyBankRepository $repository)
    {
        $this->router = $router;
        $this->template = $template;
        $this->repository = $repository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        $amount = $request->getParsedBody()['amount'];

        $piggyBank = new PiggyBank();

        $piggyBank->deposit($amount);

        $this->repository->save($piggyBank->getTotalDeposit());

        return $response->withAddedHeader('Location', '/');
    }
}
