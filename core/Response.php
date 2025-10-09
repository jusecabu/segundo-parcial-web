<?php

namespace Core;

class Response
{
    public static function status(int $code)
    {
        http_response_code($code);
    }

    public static function json(mixed $data, int $status = 200)
    {
        self::status($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit();
    }

    public static function text(string $content, int $status = 200)
    {
        self::status($status);
        header('Content-Type: text/plain');
        echo $content;
        exit();
    }

    public static function render(string $template, array $data = [], array $meta = [], string $layout = 'base')
    {
        $viewFile = __DIR__ . '/../app/views/' . $template . '.php';
        $layoutFile = __DIR__ . '/../app/views/layouts/' . $layout . '.php';

        if (!file_exists($viewFile)) {
            throw new \Exception("La vista {$template} no existe.");
        }
        if (!file_exists($layoutFile)) {
            throw new \Exception("El layout {$layout} no existe.");
        }


        extract($data);
        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        extract($meta);
        include $layoutFile;
        exit();
    }

    public static function redirect(string $url, int $status = 302)
    {
        self::status($status);
        header("Location: $url");
        exit();
    }


    public static function abort(int $code = 404)
    {
        self::status($code);
        self::render("errors/{$code}", [], ['title' => "Error {$code}"]);
        die();
    }
}
