<?php

/**
 * Vista del Formulario de Inventario
 * 
 * Estudiantes:
 * - [Nombre Completo 1] - Código: [XXXXXX]
 * - [Nombre Completo 2] - Código: [XXXXXX]
 * - [Nombre Completo 3] - Código: [XXXXXX]
 */

$this->section('pageTitle');
echo 'Formulario - Simulación de Inventario';
$this->endSection();

$inv = $values['inventory'];
$demand = $values['dailyCustomerUnitsPurchased'];
$lead = $values['supplierLeadTime'];
$lcg1 = $values['linearCongruentialGenerator1'];
$lcg2 = $values['linearCongruentialGenerator2'];

?>
<div class="max-w-7xl mx-auto">
    <!-- Encabezado -->
    <?= $this->include('inventory/partials/page-header') ?>

    <!-- Formulario -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-blue-500 pb-2">
            🎯 Parámetros de Entrada
        </h2>

        <form method="POST" action="/inventory/calculate" class="space-y-8">

            <!-- Sección: Parámetros del Inventario -->
            <?= $this->include('inventory/partials/inventory-params', ['inv' => $inv]) ?>

            <!-- Sección: Probabilidades de Demanda -->
            <?= $this->include('inventory/partials/demand-probabilities', ['demand' => $demand]) ?>

            <!-- Sección: Probabilidades de Tiempo de Entrega -->
            <?= $this->include('inventory/partials/lead-time-probabilities', ['lead' => $lead]) ?>

            <!-- Sección: Generadores Congruenciales -->
            <?= $this->include('inventory/partials/lcg-generators', ['lcg1' => $lcg1, 'lcg2' => $lcg2]) ?>

            <!-- Botón de envío -->
            <div class="flex justify-center">
                <button type="submit"
                    class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-bold py-4 px-12 rounded-lg shadow-lg hover:from-blue-700 hover:to-indigo-800 transform hover:scale-105 transition-all duration-200">
                    🚀 Calcular Simulación de Inventario (1000 días)
                </button>
            </div>
        </form>
    </div>

    <!-- Resultados -->
    <?= $this->includeWhen($showResults ?? false, 'inventory/results', [
        'results' => $results ?? [],
        'showResults' => $showResults ?? false
    ]) ?>
</div>