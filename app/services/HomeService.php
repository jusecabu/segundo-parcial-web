<?php

namespace App\Services;

use App\Models\HomeModel;

class HomeService
{
    private HomeModel $model;

    public function __construct()
    {
        $this->model = new HomeModel();
    }

    /**
     * Prepara todos los datos necesarios para la página de inicio
     */
    public function getHomePageData(): array
    {
        $siteInfo = $this->model->getSiteInfo();
        $statistics = $this->model->getStatistics();
        $features = $this->model->getFeatures();

        return [
            'pageTitle' => $siteInfo['title'],
            'siteInfo' => $siteInfo,
            'statistics' => $this->processStatistics($statistics),
            'features' => $features,
            'currentYear' => date('Y'),
            'greeting' => $this->getGreeting()
        ];
    }

    /**
     * Procesa las estadísticas agregando información adicional
     */
    private function processStatistics(array $statistics): array
    {
        return array_map(function ($stat) {
            $stat['formatted'] = $this->formatStatValue($stat['value']);
            return $stat;
        }, $statistics);
    }

    /**
     * Formatea los valores de las estadísticas
     */
    private function formatStatValue(string $value): string
    {
        // Si contiene números, los resalta
        if (preg_match('/\d/', $value)) {
            return "<strong>{$value}</strong>";
        }
        return $value;
    }

    /**
     * Obtiene un saludo basado en la hora del día
     */
    private function getGreeting(): string
    {
        $hour = (int) date('H');

        if ($hour >= 5 && $hour < 12) {
            return '¡Buenos días! ☀️';
        } elseif ($hour >= 12 && $hour < 18) {
            return '¡Buenas tardes! 🌤️';
        } else {
            return '¡Buenas noches! 🌙';
        }
    }

    /**
     * Obtiene información para la página "Acerca de"
     */
    public function getAboutPageData(): array
    {
        return [
            'pageTitle' => 'Acerca de Nosotros',
            'aboutInfo' => [
                'mission' => 'Desarrollar software de calidad con arquitecturas limpias y escalables.',
                'vision' => 'Ser referentes en el desarrollo web moderno con PHP.',
                'values' => [
                    'Calidad',
                    'Innovación',
                    'Compromiso',
                    'Excelencia'
                ]
            ],
            'team' => [
                [
                    'name' => 'Equipo de Desarrollo',
                    'role' => 'Full Stack Developers',
                    'description' => 'Apasionados por crear aplicaciones robustas y escalables.'
                ]
            ],
            'currentYear' => date('Y')
        ];
    }
}
