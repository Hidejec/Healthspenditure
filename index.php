<?php

require 'vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

new Liquido\App;

$app->get('/', "Controller\HomeController:index");

$app->post('/', "Controller\HomeController:nextpage");

$app->run();