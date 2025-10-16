<?php

namespace App\Models;

/**
 * Modelo de Inventario - Segundo Parcial Web
 * 
 * Estudiantes:
 * - [Nombre Completo 1] - Código: [XXXXXX]
 * - [Nombre Completo 2] - Código: [XXXXXX]
 * - [Nombre Completo 3] - Código: [XXXXXX]
 * 
 * Gestiona los cálculos del inventario según las reglas del negocio
 */
class InventoryModel
{
    /**
     * Obtiene los datos iniciales del inventario (valores por defecto)
     */
    public function getInitialData(): array
    {
        return [
            'inventory' => [
                'R' => 81,
                'Q' => 106,
                'initialInventory' => 570,
                'prestigeLossCostPerUndeliveredUnit' => 400,
                'orderPlacementCost' => 7000,
                'unitStorageCostPerDay' => 125,
            ],
            'dailyCustomerUnitsPurchased' => [
                25 => [
                    'probability' => 10,
                    'range' => [0.0, 0.1],
                ],
                26 => [
                    'probability' => 20,
                    'range' => [0.1, 0.3],
                ],
                27 => [
                    'probability' => 30,
                    'range' => [0.3, 0.6],
                ],
                28 => [
                    'probability' => 25,
                    'range' => [0.6, 0.85],
                ],
                29 => [
                    'probability' => 15,
                    'range' => [0.85, 1.0],
                ],
            ],
            'supplierLeadTime' => [
                3 => [
                    'probability' => 20,
                    'range' => [0.0, 0.2],
                ],
                4 => [
                    'probability' => 30,
                    'range' => [0.2, 0.5],
                ],
                5 => [
                    'probability' => 35,
                    'range' => [0.5, 0.85],
                ],
                6 => [
                    'probability' => 10,
                    'range' => [0.85, 0.95],
                ],
                7 => [
                    'probability' => 5,
                    'range' => [0.95, 1.0],
                ],
            ],
            'linearCongruentialGenerator1' => [
                'A' => 2678917,
                'X0' => 4579991,
                'B' => 1317513,
                'N' => 9824217,
            ],
            'linearCongruentialGenerator2' => [
                'A' => 7921083,
                'X0' => 6731297,
                'B' => 9021531,
                'N' => 9420811,
            ]
        ];
    }

    /**
     * Calcula el inventario para 1000 días
     */
    public function calculateInventory(array $params): array
    {
        $days = 1000;
        $results = [];

        // Extraer parámetros
        $R = $params['R'];
        $Q = $params['Q'];
        $initialInventory = $params['initialInventory'];
        $prestigeLoss = $params['prestigeLossCostPerUndeliveredUnit'];
        $orderCost = $params['orderPlacementCost'];
        $storageCost = $params['unitStorageCostPerDay'];

        $demandProbs = $params['dailyCustomerUnitsPurchased'];
        $leadTimeProbs = $params['supplierLeadTime'];

        // Generadores congruenciales
        $lcg1 = $params['linearCongruentialGenerator1'];
        $lcg2 = $params['linearCongruentialGenerator2'];

        $X1 = $lcg1['X0'];
        $X2 = $lcg2['X0'];

        // Variables de estado
        $inventory = $initialInventory;
        $countdownOrder = -1;

        // Totales
        $totalStorageCost = 0;
        $totalOrderCost = 0;
        $totalPrestigeLoss = 0;

        for ($day = 0; $day <= $days; $day++) {
            $row = ['day' => $day];

            if ($day === 0) {
                $X1 = ($lcg1['A'] * $X1 + $lcg1['B']) % $lcg1['N'];
                $azar1 = $X1 / $lcg1['N'];
                $X2 = ($lcg2['A'] * $X2 + $lcg2['B']) % $lcg2['N'];
                $azar2 = $X2 / $lcg2['N'];

                // Día 0: solo inventario inicial
                $row['azar1_x'] = $X1;
                $row['azar1'] = $azar1;
                $row['demand'] = '';
                $row['inventory'] = $initialInventory;
                $row['storage_cost'] = '';
                $row['order_cost'] = '';
                $row['azar2_x'] = $X2;
                $row['azar2'] = $azar2;
                $row['lead_time'] = '';
                $row['countdown'] = -1;
                $row['prestige_loss'] = '';

                $results[] = $row;
                continue;
            }

            // Generar Azar #1 para demanda
            $X1 = ($lcg1['A'] * $X1 + $lcg1['B']) % $lcg1['N'];
            $azar1 = $X1 / $lcg1['N'];
            $row['azar1_x'] = $X1;
            $row['azar1'] = $azar1;

            // Calcular demanda según probabilidades
            $demand = $this->getDemandFromProbability($azar1, $demandProbs);
            $row['demand'] = $demand;

            // Calcular inventario antes de procesar pedido
            $inventoryBeforeOrder = max(0, $inventory) - $demand;

            // Verificar si llega pedido
            if ($countdownOrder === 0) {
                $inventoryBeforeOrder += $Q;
            }

            $inventory = $inventoryBeforeOrder;
            $row['inventory'] = $inventory;

            // Calcular costo de almacenamiento
            $storageCostDay = $inventory > 0 ? $inventory * $storageCost : 0;
            $row['storage_cost'] = $storageCostDay;
            $totalStorageCost += $storageCostDay;

            // Verificar si se debe hacer pedido
            $shouldOrder = $inventory <= $R && $countdownOrder <= 0;
            $orderCostDay = $shouldOrder ? $orderCost : 0;
            $row['order_cost'] = $orderCostDay;
            $totalOrderCost += $orderCostDay;

            $X2 = ($lcg2['A'] * $X2 + $lcg2['B']) % $lcg2['N'];
            $row['azar2_x'] = $X2;

            // Generar Azar #2 para tiempo de entrega (solo si se hace pedido)
            if ($shouldOrder) {
                $azar2 = $X2 / $lcg2['N'];
                $row['azar2'] = $azar2;
                // Determinar tiempo de entrega
                $leadTime = $this->getLeadTimeFromProbability($azar2, $leadTimeProbs);
                $row['lead_time'] = $leadTime;
            } else {
                $row['azar2'] = -1;
                $row['lead_time'] = 0;
            }

            $row['countdown'] = $countdownOrder;

            // Iniciar cuenta regresiva
            if ($row['lead_time'] > 0) {
                $countdownOrder = $row['lead_time'];
            } elseif ($row['countdown'] > 0) {
                $countdownOrder--;
            } else {
                $countdownOrder = -1;
            }
            // Actualizar cuenta regresiva

            // Calcular costo de pérdida de prestigio
            $prestigeLossDay = $inventory < 0 ? abs($inventory) * $prestigeLoss : 0;
            $row['prestige_loss'] = $prestigeLossDay;
            $totalPrestigeLoss += $prestigeLossDay;

            $results[] = $row;
        }

        return [
            'days' => $results,
            'totals' => [
                'storage' => $totalStorageCost,
                'order' => $totalOrderCost,
                'prestige' => $totalPrestigeLoss,
                'total' => $totalStorageCost + $totalOrderCost + $totalPrestigeLoss
            ]
        ];
    }

    /**
     * Determina la demanda según el valor aleatorio y las probabilidades
     */
    private function getDemandFromProbability(float $random, array $probs): int
    {
        foreach ($probs as $units => $data) {
            if ($random >= $data['range'][0] && $random < $data['range'][1]) {
                return $units;
            }
        }
        // Por si acaso el random es exactamente 1.0
        return array_key_last($probs);
    }

    /**
     * Determina el tiempo de entrega según el valor aleatorio y las probabilidades
     */
    private function getLeadTimeFromProbability(float $random, array $probs): int
    {
        foreach ($probs as $days => $data) {
            if ($random >= $data['range'][0] && $random < $data['range'][1]) {
                return $days;
            }
        }
        // Por si acaso el random es exactamente 1.0
        return array_key_last($probs);
    }
}
