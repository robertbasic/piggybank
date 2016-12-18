<?php

declare(strict_types=1);

use PiggyBank\Application\Action\Deposit;
use PiggyBank\Application\Action\HomePage;
use PiggyBank\Application\Middleware\FlashMessages;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;
use Zend\Expressive\Application;
use Zend\Expressive\TemplatedErrorHandler;
use Zend\Expressive\WhoopsErrorHandler;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$config = require 'config/config.php';

$container = new ServiceManager();
(new Config($config['dependencies']))->configureServiceManager($container);

$container->setService('config', $config);

$router = $container->get('router');

$template = $container->get('template');

$handler = new PrettyPageHandler();

$whoops = new Whoops();
$whoops->writeToOutput(false);
$whoops->allowQuit(false);
$whoops->pushHandler($handler);

$errorHandler = new WhoopsErrorHandler($whoops, $handler, $template, 'error::404', 'error::error');

$app = new Application(
    $router,
    $container,
    $errorHandler
);

$app->pipeRoutingMiddleware();
$app->pipe(FlashMessages::class);
$app->pipeDispatchMiddleware();

$app->get('/', HomePage::class);
$app->post('/deposit', Deposit::class);

$whoops->register();
$app->run();
