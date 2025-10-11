<?php

namespace Core\Routing;

use Core\Http\Request;
use Core\Http\Response;

class Router
{
    protected static array $routes = [];
    protected static array $globalMiddlewares = [];
    protected static string $currentGroupPrefix = '';

    /** =========================
     *   REGISTRO DE RUTAS
     * ========================== */

    public static function get(string $path, callable|array $handler): Route
    {
        return self::addRoute('GET', $path, $handler);
    }

    public static function post(string $path, callable|array $handler): Route
    {
        return self::addRoute('POST', $path, $handler);
    }

    public static function put(string $path, callable|array $handler): Route
    {
        return self::addRoute('PUT', $path, $handler);
    }

    public static function delete(string $path, callable|array $handler): Route
    {
        return self::addRoute('DELETE', $path, $handler);
    }

    protected static function addRoute(string $method, string $path, callable|array $handler): Route
    {
        // Combina con prefijo del grupo
        $fullPath = rtrim(self::$currentGroupPrefix . '/' . ltrim($path, '/'), '/');
        if ($fullPath === '') $fullPath = '/';

        $route = new Route($method, $fullPath, $handler);
        self::$routes[$method][] = $route;
        return $route;
    }

    /** =========================
     *   AGRUPAMIENTO DE RUTAS
     * ========================== */

    public static function group(string $prefix, callable $callback): void
    {
        $previousPrefix = self::$currentGroupPrefix;
        self::$currentGroupPrefix .= '/' . trim($prefix, '/');
        $callback();
        self::$currentGroupPrefix = $previousPrefix;
    }

    /** =========================
     *   MIDDLEWARES
     * ========================== */

    public static function middleware(object $middleware): void
    {
        self::$globalMiddlewares[] = $middleware;
    }

    /** =========================
     *   RESOLUCIÓN DE RUTA
     * ========================== */

    public static function resolve(Request $request, Response $response): mixed
    {
        $method = $request->getMethod();
        $path = $request->getPath();

        if (empty(self::$routes[$method])) {
            return $response->html('<h1>405 Method Not Allowed</h1>')->setStatusCode(405);
        }

        foreach (self::$routes[$method] as $route) {
            $params = $route->match($path);
            if ($params !== false) {
                // Ejecutar middlewares globales y de la ruta
                $middlewares = [...self::$globalMiddlewares, ...$route->getMiddlewares()];
                return self::runMiddlewares($middlewares, $request, $response, function () use ($route, $params, $request, $response) {
                    return $route->execute($request, $response, $params);
                });
            }
        }

        return $response->html('<h1>404 Not Found</h1>')->setStatusCode(404);
    }

    /** =========================
     *   EJECUCIÓN DE MIDDLEWARES
     * ========================== */

    protected static function runMiddlewares(array $middlewares, Request $req, Response $res, callable $next): mixed
    {
        $middleware = array_shift($middlewares);

        if (!$middleware) {
            return $next();
        }

        return $middleware->handle($req, $res, function () use ($middlewares, $req, $res, $next) {
            return self::runMiddlewares($middlewares, $req, $res, $next);
        });
    }

    /** =========================
     *   RESETEAR ESTADO (útil para testing)
     * ========================== */

    public static function reset(): void
    {
        self::$routes = [];
        self::$globalMiddlewares = [];
        self::$currentGroupPrefix = '';
    }
}
