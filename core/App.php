<?php

namespace Core;

class App
{
    static public function run()
    {
        foreach (glob(__DIR__ . '/../app/routes/*.php') as $filename) {
            require $filename;
        }

        Router::dispatch();
    }
}
