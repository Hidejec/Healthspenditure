<?php

require 'vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$app->get('/', "Controller\HomeController:index");

$app->get('/{illness}', "Controller\IllnessController:index");

$app->get('/{illness}/recipe', "Controller\IllnessController:recipe");

$app->run();