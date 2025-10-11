<?php

namespace Core\Routing;

use Core\Http\Request;
use Core\Http\Response;

class Route
{
    protected string $method;
    protected string $path;
    protected $handler;
    protected array $middlewares = [];

    public function __construct(string $method, string $path, callable|array $handler)
    {
        $this->method = $method;
        $this->path = $path;
        $this->handler = $handler;
    }

    public function middleware(object $middleware): self
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    /** Coincidencia de ruta con parámetros dinámicos */
    public function match(string $uri): array|false
    {
        $pattern = preg_replace('#\{([^/]+)\}#', '([^/]+)', $this->path);
        $pattern = "#^{$pattern}$#";

        if (preg_match($pattern, $uri, $matches)) {
            array_shift($matches);
            preg_match_all('#\{([^/]+)\}#', $this->path, $paramNames);
            return array_combine($paramNames[1], $matches);
        }

        return false;
    }

    /** Ejecuta el callback asignado */
    public function execute(Request $req, Response $res, array $params): mixed
    {
        $handler = $this->handler;

        // Caso: controlador tipo [Clase::class, 'metodo']
        if (is_array($handler)) {
            [$class, $method] = $handler;
            $instance = new $class();
            return $instance->$method($req, $res, ...array_values($params));
        }

        // Caso: función anónima
        return call_user_func_array($handler, [$req, $res, ...array_values($params)]);
    }
}
