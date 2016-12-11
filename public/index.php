<?php

declare(strict_types=1);

use Zend\Expressive\Application;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

use Zend\Expressive\TemplatedErrorHandler;
use Zend\Expressive\WhoopsErrorHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use PiggyBank\Application\Action\HomePage;
use PiggyBank\Application\Action\Deposit;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$config = require 'config/config.php';

$container = new ServiceManager();
(new Config($config['dependencies']))->configureServiceManager($container);

$container->setService('config', $config);

$router = $container->get('router');

$template = $container->get('template');
/*
$errorHandler = new TemplatedErrorHandler($template, 'error::404', 'error::error');
*/

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
$app->pipeDispatchMiddleware();

$app->get('/', HomePage::class);
$app->post('/deposit', Deposit::class);

$whoops->register();
$app->run();
