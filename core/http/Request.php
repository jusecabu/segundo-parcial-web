<?php

namespace Core\Http;

class Request
{
    protected string $method;
    protected string $uri;
    protected array $query;
    protected array $body;
    protected array $headers;
    protected array $files;
    protected array $cookies;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = strtok($_SERVER['REQUEST_URI'], '?');
        $this->query = $_GET;
        $this->body = $_POST;
        $this->headers = getallheaders();
        $this->files = $_FILES;
        $this->cookies = $_COOKIE;
    }

    public function getMethod(): string
    {
        return strtoupper($this->method);
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getPath(): string
    {
        return parse_url($this->uri, PHP_URL_PATH);
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
