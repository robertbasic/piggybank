<?php

declare(strict_types=1);

namespace PiggyBank\Application\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use InvalidArgumentException;
use PiggyBank\Application\Service\Deposit as DepositService;
use PiggyBank\Application\Service\Exception\RepositoryException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
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

    public function __invoke(ServerRequestInterface $request, DelegateInterface $delegate) : ResponseInterface
    {
        $amount = $request->getParsedBody()['amount'];

        try {
            $this->deposit->deposit($amount);
            $message = ['success', 'Amount deposited!'];
        } catch (InvalidArgumentException $e) {
            $message = ['error', $e->getMessage()];
        } catch (RepositoryException $e) {
            $message = ['error', $e->getMessage()];
        }

        $flash = $request->getAttribute('flash');
        $flash->addMessage($message[0], $message[1]);

        return new RedirectResponse('/');
    }
}
