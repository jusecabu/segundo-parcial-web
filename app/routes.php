<?php

use Core\Routing\Router;
use App\Controllers\HomeController;

// El Router se pasa como parámetro a este archivo
/** @var Router $router */

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);
$router->group('/api', function (Router $router) {
    $router->get('/data', [HomeController::class, 'apiData']);
});

// ============================================
//  MIDDLEWARES GLOBALES
// ============================================

// Ejemplo de middleware global (comentado):
// $router->middleware(new AuthMiddleware());
// $router->middleware(new CorsMiddleware());

// ============================================
//  RUTAS CON CLOSURES
// ============================================

// También puedes definir rutas con funciones anónimas:
$router->get('/test', function ($request, $response) {
    return $response->json([
        'message' => 'Ruta de prueba funcionando',
        'status' => 'success',
        'framework' => 'Custom PHP MVC'
    ]);
});
