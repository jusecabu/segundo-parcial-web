<?php

namespace Core\Application;

use Core\Routing\Router;
use Core\Http\Request;
use Core\Http\Response;

class App
{
    public function __construct(
        protected Router $router,
        protected Request $request,
        protected Response $response
    ) {}

    public function run(): void
    {
        $result = $this->router->resolve($this->request, $this->response);

        if ($result instanceof Response) {
            $result->send();
        } elseif (is_string($result)) {
            $this->response->html($result)->send();
        }
    }
}
