<?php

use Core\Routing\Router;
use App\Controllers\HomeController;
use Core\Http\Response;

Router::get('/', [HomeController::class, 'index']);
Router::get('/about', [HomeController::class, 'about']);
Router::group('/api', function () {
    Router::get('/data', [HomeController::class, 'apiData']);
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
Router::get('/test', function ($_, Response $response) {
    return $response->json([
        'message' => 'Ruta de prueba funcionando',
        'status' => 'success',
        'framework' => 'Custom PHP MVC'
    ]);
});
