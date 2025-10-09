<?php

namespace Core;

class Request
{
    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function uri(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public static function input(string $key, $default = null)
    {
        return $_REQUEST[$key] ?? $default;
    }

    public static function json(): array
    {
        return json_decode(file_get_contents('php://input'), true) ?? [];
    }
}
