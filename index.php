<?php

require 'vendor/autoload.php';

$settings = require_once __DIR__ . '/app/settings.php';
$app = new \Slim\App($settings);

session_start();

require_once __DIR__ . '/app/dependencies.php';

require_once __DIR__ . '/app/middleware.php';

require_once __DIR__ . '/app/routes.php';

$app->run();