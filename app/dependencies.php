<?php

//Dependency Containers and Initializations

$container = $app->getContainer();

$container["view"] = function($container){ 

 	$view = new \Slim\Views\Twig('public/views', [
        'cache' => false
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));
	
    return $view;
};

new \Liquido\App;
new Controllers\BaseController($container);