<?php

namespace Core\Http;

class Response
{
    protected int $statusCode = 200;
    protected array $headers = [];
    protected string $content = '';
    protected bool $sent = false;

    public function setStatusCode(int $code): self
    {
        $this->statusCode = $code;

        http_response_code($code);

        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    public function getHeader(string $name): ?string
    {
        return $this->headers[$name] ?? null;
    }

    public function json(array $data, int $status = 200): self
    {
        $this->setStatusCode($status);
        $this->setHeader('Content-Type', 'application/json; charset=utf-8');

        $this->content = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function html(string $html, int $status = 200): self
    {
        $this->setStatusCode($status);
        $this->setHeader('Content-Type', 'text/html; charset=utf-8');

        $this->content = $html;

        return $this;
    }

    public function text(string $text, int $status = 200): self
    {
        $this->setStatusCode($status);
        $this->setHeader('Content-Type', 'text/plain; charset=utf-8');

        $this->content = $text;

        return $this;
    }

    public function redirect(string $url, int $status = 302): never
    {
        $this->setStatusCode($status);

        header("Location: $url", true, $status);

        exit;
    }

    public function send(): void
    {
        if ($this->sent) {
            return;
        }

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        http_response_code($this->statusCode);
        echo $this->content;

        $this->sent = true;
    }
}
