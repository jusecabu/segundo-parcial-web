<?php

namespace App\Controllers;

use Core\Http\Request;
use Core\Http\Response;
use Core\View\View;
use App\Services\HomeService;

class HomeController
{
    private HomeService $homeService;

    public function __construct()
    {
        $this->homeService = new HomeService();
    }

    public function index(Request $req, Response $res): string
    {
        $data = $this->homeService->getHomePageData();
        $view = View::make('home/index', $data)->withLayout('layouts/main', [
            'title' => $data['pageTitle']
        ]);

        return $view->render();
    }
}
