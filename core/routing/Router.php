<?php

namespace Core\Routing;

use Core\Http\Request;
use Core\Http\Response;

class Router
{
    protected array $routes = [];
    protected array $globalMiddlewares = [];
    protected string $currentGroupPrefix = '';

    /** =========================
     *   REGISTRO DE RUTAS
     * ========================== */

    public function get(string $path, callable|array $handler): Route
    {
        return $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, callable|array $handler): Route
    {
        return $this->addRoute('POST', $path, $handler);
    }

    public function put(string $path, callable|array $handler): Route
    {
        return $this->addRoute('PUT', $path, $handler);
    }

    public function delete(string $path, callable|array $handler): Route
    {
        return $this->addRoute('DELETE', $path, $handler);
    }

    protected function addRoute(string $method, string $path, callable|array $handler): Route
    {
        // Combina con prefijo del grupo
        $fullPath = rtrim($this->currentGroupPrefix . '/' . ltrim($path, '/'), '/');
        if ($fullPath === '') $fullPath = '/';

        $route = new Route($method, $fullPath, $handler);
        $this->routes[$method][] = $route;
        return $route;
    }

    /** =========================
     *   AGRUPAMIENTO DE RUTAS
     * ========================== */

    public function group(string $prefix, callable $callback): void
    {
        $previousPrefix = $this->currentGroupPrefix;
        $this->currentGroupPrefix .= '/' . trim($prefix, '/');
        $callback($this);
        $this->currentGroupPrefix = $previousPrefix;
    }

    /** =========================
     *   MIDDLEWARES
     * ========================== */

    public function middleware(object $middleware): void
    {
        $this->globalMiddlewares[] = $middleware;
    }

    /** =========================
     *   RESOLUCIÓN DE RUTA
     * ========================== */

    public function resolve(Request $request, Response $response): mixed
    {
        $method = $request->getMethod();
        $path = $request->getPath();

        if (empty($this->routes[$method])) {
            return $response->html('<h1>405 Method Not Allowed</h1>')->setStatusCode(405);
        }

        foreach ($this->routes[$method] as $route) {
            $params = $route->match($path);
            if ($params !== false) {
                // Ejecutar middlewares globales y de la ruta
                $middlewares = [...$this->globalMiddlewares, ...$route->getMiddlewares()];
                return $this->runMiddlewares($middlewares, $request, $response, function () use ($route, $params, $request, $response) {
                    return $route->execute($request, $response, $params);
                });
            }
        }

        return $response->html('<h1>404 Not Found</h1>')->setStatusCode(404);
    }

    /** =========================
     *   EJECUCIÓN DE MIDDLEWARES
     * ========================== */

    protected function runMiddlewares(array $middlewares, Request $req, Response $res, callable $next)
    {
        $middleware = array_shift($middlewares);

        if (!$middleware) {
            return $next();
        }

        return $middleware->handle($req, $res, function () use ($middlewares, $req, $res, $next) {
            return $this->runMiddlewares($middlewares, $req, $res, $next);
        });
    }
}
