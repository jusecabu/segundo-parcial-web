<?php

namespace Core\Application;

use Core\Routing\Router;
use Core\Http\Request;
use Core\Http\Response;

class App
{

    public static function run(): void
    {
        $request = new Request();
        $response = new Response();
        $result = Router::resolve($request, $response);

        if ($result instanceof Response) {
            $result->send();
        } elseif (is_string($result)) {
            $response->html($result)->send();
        }
    }
}
