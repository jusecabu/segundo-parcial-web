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

    /**
     * Muestra la página de inicio
     */
    public function index(): string
    {
        // Obtener los datos del servicio
        $data = $this->homeService->getHomePageData();

        // Crear la vista con layout
        $view = View::make('home/index', $data)
            ->withLayout('layouts/main', [
                'title' => $data['pageTitle'],
                'metaDescription' => $data['siteInfo']['description']
            ]);

        // Retornar la respuesta HTML
        return $view->render();
    }

    /**
     * Muestra la página "Acerca de"
     */
    public function about(Request $request, Response $response): string
    {
        // Obtener los datos del servicio
        $data = $this->homeService->getAboutPageData();

        // Crear la vista con layout
        $view = View::make('home/about', $data)
            ->withLayout('layouts/main', [
                'title' => $data['pageTitle'],
                'metaDescription' => 'Conoce más sobre nuestro equipo y misión'
            ]);

        // Retornar la respuesta HTML
        return $view->render();
    }

    /**
     * API endpoint que retorna datos en JSON
     */
    public function apiData(Request $request, Response $response): Response
    {
        $data = $this->homeService->getHomePageData();

        // Retornar respuesta JSON
        return $response->json([
            'success' => true,
            'data' => $data,
            'timestamp' => time()
        ]);
    }
}
