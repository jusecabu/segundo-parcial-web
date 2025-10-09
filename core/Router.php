<?php

namespace Core;

class Router
{
    private static array $routes = [];
    private static string $prefix = '';
    private static array $middlewares = [];

    public static function get(string $path, callable|array $callback, array $middlewares = [])
    {
        self::addRoute('GET', $path, $callback, $middlewares);
    }

    public static function post(string $path, callable|array $callback, array $middlewares = [])
    {
        self::addRoute('POST', $path, $callback, $middlewares);
    }

    public static function put(string $path, callable|array $callback, array $middlewares = [])
    {
        self::addRoute('PUT', $path, $callback, $middlewares);
    }

    public static function delete(string $path, callable|array $callback, array $middlewares = [])
    {
        self::addRoute('DELETE', $path, $callback, $middlewares);
    }

    private static function addRoute(string $method, string $path, callable|array $callback, array $middlewares)
    {
        $path = self::$prefix . $path;
        self::$routes[$method][$path] = [
            'callback' => $callback,
            'middlewares' => $middlewares
        ];
    }

    public static function group(string $prefix, callable $callback)
    {
        $previousPrefix = self::$prefix;
        self::$prefix .= $prefix;
        $callback();
        self::$prefix = $previousPrefix;
    }

    public static function use(callable $middleware)
    {
        self::$middlewares[] = $middleware;
    }

    public static function dispatch()
    {
        $method = Request::method();
        $uri = Request::uri();

        if (!isset(self::$routes[$method])) {
            Response::json(["message" => "Método no permitido"], 405);
            return;
        }

        foreach (self::$routes[$method] as $path => $route) {
            $pattern = preg_replace('#\{([a-zA-Z0-9_]+)\}#', '([^/]+)', $path);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);

                foreach (self::$middlewares as $mw) {
                    if ($mw() === false) return;
                }

                foreach ($route['middlewares'] as $mw) {
                    if ($mw() === false) return;
                }

                $callback = $route['callback'];
                if (is_array($callback)) {
                    [$class, $method] = $callback;
                    return call_user_func_array([new $class, $method], $matches);
                } else {
                    return call_user_func_array($callback, $matches);
                }
            }
        }

        Response::abort(404);
    }
}
