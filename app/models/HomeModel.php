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
            'title' => 'Bienvenido a Mi Aplicación',
            'subtitle' => 'Framework PHP Moderno',
            'description' => 'Una aplicación web construida con arquitectura MVC limpia y moderna.',
            'version' => '1.0.0'
        ];
    }

    /**
     * Obtiene estadísticas del home
     */
    public function getStatistics(): array
    {
        return [
            [
                'label' => 'Usuarios Activos',
                'value' => '1,234',
                'icon' => '👥'
            ],
            [
                'label' => 'Proyectos Completados',
                'value' => '56',
                'icon' => '✅'
            ],
            [
                'label' => 'Horas de Desarrollo',
                'value' => '2,890',
                'icon' => '⏱️'
            ],
            [
                'label' => 'Clientes Satisfechos',
                'value' => '98%',
                'icon' => '⭐'
            ]
        ];
    }

    /**
     * Obtiene características destacadas
     */
    public function getFeatures(): array
    {
        return [
            [
                'title' => 'Arquitectura MVC',
                'description' => 'Separación clara de responsabilidades con Controllers, Models, Services y Views.',
                'icon' => '🏗️'
            ],
            [
                'title' => 'Sistema de Routing',
                'description' => 'Router flexible con soporte para parámetros dinámicos y middlewares.',
                'icon' => '🛣️'
            ],
            [
                'title' => 'HTTP Moderno',
                'description' => 'Manejo robusto de Request y Response con soporte para JSON.',
                'icon' => '🌐'
            ],
            [
                'title' => 'Vistas con Layouts',
                'description' => 'Sistema de templates con layouts reutilizables y metadata.',
                'icon' => '🎨'
            ]
        ];
    }
}
