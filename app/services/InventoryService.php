<?php

namespace App\Services;

use App\Models\InventoryModel;

/**
 * Servicio de Inventario
 * 
 * Coordina la lógica de negocio entre el controlador y el modelo
 */
class InventoryService
{
    private InventoryModel $model;

    public function __construct()
    {
        $this->model = new InventoryModel();
    }

    /**
     * Obtiene los datos iniciales del inventario
     */
    public function getInitialData(): array
    {
        return $this->model->getInitialData();
    }

    /**
     * Procesa el formulario y calcula el inventario
     */
    public function processInventorySimulation(array $formData): array
    {
        // Parsear los datos del formulario
        $params = $this->parseFormData($formData);

        // Calcular inventario
        $results = $this->model->calculateInventory($params);

        return [
            'params' => $params,
            'results' => $results
        ];
    }

    /**
     * Convierte los datos del formulario al formato esperado por el modelo
     */
    private function parseFormData(array $data): array
    {
        return [
            'R' => (int)$data['R'],
            'Q' => (int)$data['Q'],
            'initialInventory' => (int)$data['initialInventory'],
            'prestigeLossCostPerUndeliveredUnit' => (float)$data['prestigeLoss'],
            'orderPlacementCost' => (float)$data['orderCost'],
            'unitStorageCostPerDay' => (float)$data['storageCost'],
            'dailyCustomerUnitsPurchased' => [
                25 => [
                    'probability' => (int)$data['demand_25_prob'],
                    'range' => [(float)$data['demand_25_min'], (float)$data['demand_25_max']],
                ],
                26 => [
                    'probability' => (int)$data['demand_26_prob'],
                    'range' => [(float)$data['demand_26_min'], (float)$data['demand_26_max']],
                ],
                27 => [
                    'probability' => (int)$data['demand_27_prob'],
                    'range' => [(float)$data['demand_27_min'], (float)$data['demand_27_max']],
                ],
                28 => [
                    'probability' => (int)$data['demand_28_prob'],
                    'range' => [(float)$data['demand_28_min'], (float)$data['demand_28_max']],
                ],
                29 => [
                    'probability' => (int)$data['demand_29_prob'],
                    'range' => [(float)$data['demand_29_min'], (float)$data['demand_29_max']],
                ],
            ],
            'supplierLeadTime' => [
                3 => [
                    'probability' => (int)$data['lead_3_prob'],
                    'range' => [(float)$data['lead_3_min'], (float)$data['lead_3_max']],
                ],
                4 => [
                    'probability' => (int)$data['lead_4_prob'],
                    'range' => [(float)$data['lead_4_min'], (float)$data['lead_4_max']],
                ],
                5 => [
                    'probability' => (int)$data['lead_5_prob'],
                    'range' => [(float)$data['lead_5_min'], (float)$data['lead_5_max']],
                ],
                6 => [
                    'probability' => (int)$data['lead_6_prob'],
                    'range' => [(float)$data['lead_6_min'], (float)$data['lead_6_max']],
                ],
                7 => [
                    'probability' => (int)$data['lead_7_prob'],
                    'range' => [(float)$data['lead_7_min'], (float)$data['lead_7_max']],
                ],
            ],
            'linearCongruentialGenerator1' => [
                'A' => (int)$data['lcg1_A'],
                'X0' => (int)$data['lcg1_X0'],
                'B' => (int)$data['lcg1_B'],
                'N' => (int)$data['lcg1_N'],
            ],
            'linearCongruentialGenerator2' => [
                'A' => (int)$data['lcg2_A'],
                'X0' => (int)$data['lcg2_X0'],
                'B' => (int)$data['lcg2_B'],
                'N' => (int)$data['lcg2_N'],
            ]
        ];
    }
}
