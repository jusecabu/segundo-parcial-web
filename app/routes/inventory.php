<?php

/**
 * Rutas del módulo de Inventario
 * 
 * Segundo Parcial - Programación Web
 * Estudiantes:
 * - [Nombre Completo 1] - Código: [XXXXXX]
 * - [Nombre Completo 2] - Código: [XXXXXX]
 * - [Nombre Completo 3] - Código: [XXXXXX]
 */

use Core\Routing\Router;
use App\Controllers\InventoryController;

// Mostrar formulario inicial con valores por defecto
Router::get('/inventory', [InventoryController::class, 'index']);

// Procesar formulario y mostrar resultados
Router::post('/inventory/calculate', [InventoryController::class, 'calculate']);

// API: Exportar resultados como JSON (opcional)
Router::post('/inventory/export-json', [InventoryController::class, 'exportJson']);
