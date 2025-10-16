<?php

namespace App\Controllers;

use Core\Http\Request;
use Core\Http\Response;
use Core\View\View;
use App\Services\InventoryService;

/**
 * Controlador de Inventario - Segundo Parcial Web
 * 
 * Gestiona las peticiones relacionadas con la simulación del inventario
 */
class InventoryController
{
    private InventoryService $service;

    public function __construct()
    {
        $this->service = new InventoryService();
    }

    /**
     * Muestra el formulario de entrada con valores por defecto
     */
    public function index(Request $req, Response $res): string
    {
        $initialData = $this->service->getInitialData();

        $view = View::make('inventory/form', [
            'values' => $initialData,
            'showResults' => false
        ])->withLayout('layouts/main', [
            'title' => 'Simulación de Inventario - Segundo Parcial Web'
        ]);

        return $view->render();
    }

    /**
     * Procesa el formulario y muestra los resultados
     */
    public function calculate(Request $req, Response $res): string
    {
        $formData = $req->getBody();

        // Calcular inventario
        $simulation = $this->service->processInventorySimulation($formData);

        $view = View::make('inventory/form', [
            'values' => $this->service->getInitialData(),
            'showResults' => true,
            'results' => $simulation['results'],
            'params' => $simulation['params']
        ])->withLayout('layouts/main', [
            'title' => 'Resultados - Simulación de Inventario'
        ]);

        return $view->render();
    }

    /**
     * Exporta los resultados como JSON (opcional)
     */
    public function exportJson(Request $req, Response $res): Response
    {
        $formData = $req->getBody();

        if (empty($formData)) {
            return $res->json([
                'error' => 'No se recibieron datos'
            ], 400);
        }

        $simulation = $this->service->processInventorySimulation($formData);

        return $res->json($simulation['results']);
    }
}
