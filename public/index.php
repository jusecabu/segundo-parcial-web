<?php

date_default_timezone_set('America/Bogota');

require __DIR__ . '/../vendor/autoload.php';

use Core\Routing\Router;
use Core\Http\Request;
use Core\Http\Response;
use Core\Application\App;

$router = new Router();

require_once __DIR__ . '/../app/routes.php';

$response = new Response();
$request = new Request();
$app = new App($router, $request, $response);

$app->run();
