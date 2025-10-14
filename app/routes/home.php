<?php

use Core\Routing\Router;
use Core\Http\Response;
use App\Controllers\HomeController;

Router::get('/', [HomeController::class, 'index']);
Router::get('/test', function ($_, Response $response) {
    return $response->json([
        'message' => 'Ruta de prueba funcionando',
        'status' => 'success',
        'framework' => 'Custom PHP MVC'
    ]);
});
