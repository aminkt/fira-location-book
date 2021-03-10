<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', \Fira\App\Controller\IndexController::class.':indexAction');
$app->get('/doc', \Fira\App\Controller\IndexController::class.':docAction');


$app->get('/location', \Fira\App\Controller\LocationController::class.':indexAction');
$app->post('/location', \Fira\App\Controller\LocationController::class.':createAction');

$app->run();