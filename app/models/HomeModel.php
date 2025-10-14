<?php

namespace App\Models;

class HomeModel
{
    /**
     * Obtiene información general del sitio
     */
    public function getSiteInfo(): array
    {
        return [
            'title' => 'Segundo Parcial - Programación WEB',
            'subtitle' => 'Framework PHP Moderno',
            'description' => 'Una aplicación web construida con arquitectura MVC limpia y moderna.',
            'version' => '1.0.0'
        ];
    }

    public function getInitialData(): array
    {
        return [
            'inventory' => [
                'R' => 81,
                'Q' => 106,
                'initialInventory' => 570,
                'prestigeLossCostPerUndeliveredUnit' => 400,
                'orderPlacementCost' => 7_000,
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
                    'range' => [0.85, 1],
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
                    'range' => [0.95, 1],
                ],
            ]
        ];
    }
}
