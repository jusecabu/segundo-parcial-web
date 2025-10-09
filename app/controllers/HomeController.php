<?php

namespace App\Controllers;

use Core\Response;

class HomeController
{
    public function index()
    {
        Response::render('home', ['name' => 'World'], ['title' => 'Home Page']);
    }

    public function about()
    {
        Response::json(['message' => 'About Us Page']);
    }
}
