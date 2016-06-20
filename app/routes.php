<?php

$app->get('/', "Controllers\HomeController:index");

$app->post('/', "Controllers\HomeController:search");

$app->get('/explain/recommended/{foodname}', "Controllers\ExplainController:recommended");

$app->get('/explain/avoid/{foodname}', "Controllers\ExplainController:avoid");
