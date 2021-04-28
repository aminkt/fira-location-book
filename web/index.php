<?php

use Fira\App\Controller\AuthController;
use Fira\App\Controller\IndexController;
use Fira\App\Controller\LocationController;
use Fira\App\Middleware\AuthMiddleware;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->post('/auth/user', AuthController::class.':registerAction');
$app->post('/auth/access-token', AuthController::class.':getAccessTokenAction');

$app->get('/', IndexController::class.':indexAction');
$app->get('/doc', IndexController::class.':docAction');

$app->get('/location', LocationController::class.':indexAction')->add(new AuthMiddleware());
$app->post('/location', LocationController::class.':createAction')->add(new AuthMiddleware());

$app->run();