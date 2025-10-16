<?php

namespace Core\Http;

class Request
{
    protected string $method;
    protected string $uri;
    protected string $basePath;
    protected array $query;
    protected array $body;
    protected array $headers;
    protected array $files;
    protected array $cookies;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = strtok($_SERVER['REQUEST_URI'], '?');
        $this->basePath = $this->detectBasePath();
        $this->query = $_GET;
        $this->body = $_POST;
        $this->headers = getallheaders();
        $this->files = $_FILES;
        $this->cookies = $_COOKIE;
    }

    protected function detectBasePath(): string
    {
        $scriptName = $_SERVER['SCRIPT_NAME']; // Ej: /mi-trabajo/index.php
        $scriptDir = str_replace('\\', '/', dirname($scriptName)); // Ej: /mi-trabajo

        // Si está en la raíz, retorna cadena vacía
        if ($scriptDir === '/' || $scriptDir === '.') {
            return '';
        }

        return $scriptDir;
    }

    public function getMethod(): string
    {
        return strtoupper($this->method);
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getBasePath(): string
    {
        return $this->basePath;
    }

    public function getPath(): string
    {
        $path = parse_url($this->uri, PHP_URL_PATH);

        // Remover el base path si existe
        if ($this->basePath !== '' && str_starts_with($path, $this->basePath)) {
            $path = substr($path, strlen($this->basePath));
        }

        // Normalizar: remover trailing slash excepto para la raíz
        $path = '/' . trim($path, '/');

        return $path;
    }

    public function getQuery(?string $key = null, mixed $default = null): mixed
    {
        return $key ? ($this->query[$key] ?? $default) : $this->query;
    }

    public function getBody(?string $key = null, mixed $default = null): mixed
    {
        if (empty($this->body) && $this->isJson()) {
            $this->body = json_decode(file_get_contents('php://input'), true) ?? [];
        }

        return $key ? ($this->body[$key] ?? $default) : $this->body;
    }

    public function isJson(): bool
    {
        return str_contains($this->getHeader('Content-Type') ?? '', 'application/json');
    }

    public function getHeader(string $name): ?string
    {
        return $this->headers[$name] ?? $this->headers[strtolower($name)] ?? null;
    }

    public function getAllHeaders(): array
    {
        return $this->headers;
    }

    public function isMethod(string $method): bool
    {
        return strtoupper($this->method) === strtoupper($method);
    }

    public function all(): array
    {
        return array_merge($this->query, $this->body);
    }
}
