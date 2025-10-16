<?php

/**
 * Vista de Resultados de la Simulación
 */

$this->section('pageTitle');
echo 'Resultados - Simulación de Inventario';
$this->endSection();

$days = $results['days'] ?? [];
$totals = $results['totals'] ?? [];

?>

<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <!-- Encabezado de Resultados -->
    <div class="bg-gradient-to-r from-green-500 to-teal-600 text-white rounded-lg p-6 mb-6">
        <h2 class="text-3xl font-bold mb-2">✅ RESULTADOS DE LA SIMULACIÓN</h2>
        <p class="text-lg">Inventario calculado para 1000 días según los parámetros especificados</p>
    </div>

    <!-- Totales -->
    <div class="bg-yellow-50 rounded-lg p-6 mb-6 border-2 border-yellow-300">
        <h3 class="text-2xl font-bold mb-4 text-yellow-800 text-center">💰 COSTOS TOTALES</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg p-4 shadow text-center">
                <p class="text-sm text-gray-600 mb-1">Costo Total</p>
                <p class="text-2xl font-bold text-red-600">$<?= number_format($totals['total'], 2) ?></p>
            </div>
            <div class="bg-white rounded-lg p-4 shadow text-center">
                <p class="text-sm text-gray-600 mb-1">Costo Inventario</p>
                <p class="text-2xl font-bold text-blue-600">$<?= number_format($totals['storage'], 2) ?></p>
            </div>
            <div class="bg-white rounded-lg p-4 shadow text-center">
                <p class="text-sm text-gray-600 mb-1">Costo Ordenar</p>
                <p class="text-2xl font-bold text-green-600">$<?= number_format($totals['order'], 2) ?></p>
            </div>
            <div class="bg-white rounded-lg p-4 shadow text-center">
                <p class="text-sm text-gray-600 mb-1">Costo Prestigio</p>
                <p class="text-2xl font-bold text-purple-600">$<?= number_format($totals['prestige'], 2) ?></p>
            </div>
        </div>
    </div>

    <!-- Tabla de Resultados -->
    <div class="bg-blue-50 rounded-lg p-6 border-2 border-blue-200">
        <h3 class="text-xl font-bold mb-4 text-blue-800">📋 RESULTADOS DETALLADOS DEL INVENTARIO</h3>

        <div class="overflow-x-auto max-h-96 overflow-y-auto">
            <table class="w-full text-xs border-collapse">
                <thead class="sticky top-0 bg-blue-600 text-white">
                    <tr>
                        <th class="border border-blue-700 px-2 py-2 text-center" rowspan="2">Día</th>
                        <th class="border border-blue-700 px-2 py-2 text-center" colspan="2">Números Aleatorios Demanda</th>
                        <th class="border border-blue-700 px-2 py-2 text-center" rowspan="2">Demanda</th>
                        <th class="border border-blue-700 px-2 py-2 text-center" rowspan="2">Inventario</th>
                        <th class="border border-blue-700 px-2 py-2 text-center" rowspan="2">Costo Inventario</th>
                        <th class="border border-blue-700 px-2 py-2 text-center" rowspan="2">Costo Ordenar</th>
                        <th class="border border-blue-700 px-2 py-2 text-center" colspan="2">Números Aleatorios Pedido</th>
                        <th class="border border-blue-700 px-2 py-2 text-center" rowspan="2">Llega Pedido</th>
                        <th class="border border-blue-700 px-2 py-2 text-center" rowspan="2">Cuenta Atrás Pedido</th>
                        <th class="border border-blue-700 px-2 py-2 text-center" rowspan="2">Costo Pérdida Prestigio</th>
                    </tr>
                    <tr>
                        <th class="border border-blue-700 px-2 py-1 text-center bg-blue-500">Azar #1 X</th>
                        <th class="border border-blue-700 px-2 py-1 text-center bg-blue-500">Azar #1</th>
                        <th class="border border-blue-700 px-2 py-1 text-center bg-blue-500">#Azar</th>
                        <th class="border border-blue-700 px-2 py-1 text-center bg-blue-500">Azar #2</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach ($days as $day): ?>
                        <tr class="<?= $day['day'] % 2 === 0 ? 'bg-gray-50' : 'bg-white' ?> hover:bg-blue-50">
                            <!-- Día -->
                            <td class="border border-gray-300 px-2 py-1 text-center font-semibold"><?= $day['day'] ?></td>

                            <!-- Azar #1 X -->
                            <td class="border border-gray-300 px-2 py-1 text-right">
                                <?= $day['azar1_x'] !== '' ? number_format($day['azar1_x'], 0) : '' ?>
                            </td>

                            <!-- Azar #1 -->
                            <td class="border border-gray-300 px-2 py-1 text-right">
                                <?= $day['azar1'] !== '' ? number_format($day['azar1'], 8) : '' ?>
                            </td>

                            <!-- Demanda -->
                            <td class="border border-gray-300 px-2 py-1 text-center bg-yellow-50 font-semibold">
                                <?= $day['demand'] !== '' ? $day['demand'] : '' ?>
                            </td>

                            <!-- Inventario -->
                            <td class="border border-gray-300 px-2 py-1 text-right <?= $day['inventory'] < 0 ? 'bg-red-100 font-bold text-red-700' : 'bg-green-50' ?>">
                                <?= number_format($day['inventory'], 0) ?>
                            </td>

                            <!-- Costo Inventario -->
                            <td class="border border-gray-300 px-2 py-1 text-right">
                                <?= $day['storage_cost'] !== '' ? '$' . number_format($day['storage_cost'], 2) : '' ?>
                            </td>

                            <!-- Costo Ordenar -->
                            <td class="border border-gray-300 px-2 py-1 text-right <?= $day['order_cost'] > 0 ? 'bg-orange-100 font-semibold' : '' ?>">
                                <?= $day['order_cost'] !== '' ? '$' . number_format($day['order_cost'], 2) : '' ?>
                            </td>

                            <!-- #Azar (X2) -->
                            <td class="border border-gray-300 px-2 py-1 text-right">
                                <?= $day['azar2_x'] != -1 ? number_format($day['azar2_x'], 0) : '' ?>
                            </td>

                            <!-- Azar #2 -->
                            <td class="border border-gray-300 px-2 py-1 text-right">
                                <?= $day['azar2'] != -1 ? number_format($day['azar2'], 8) : '' ?>
                            </td>

                            <!-- Llega Pedido -->
                            <td class="border border-gray-300 px-2 py-1 text-center">
                                <?= $day['lead_time'] !== '' ? $day['lead_time'] : '' ?>
                            </td>

                            <!-- Cuenta Atrás Pedido -->
                            <td class="border border-gray-300 px-2 py-1 text-center <?= $day['countdown'] > 0 ? 'bg-blue-100 font-semibold' : '' ?>">
                                <?= $day['countdown'] ?>
                            </td>

                            <!-- Costo Pérdida Prestigio -->
                            <td class="border border-gray-300 px-2 py-1 text-right <?= $day['prestige_loss'] > 0 ? 'bg-red-200 font-bold text-red-800' : '' ?>">
                                <?= $day['prestige_loss'] !== '' ? '$' . number_format($day['prestige_loss'], 2) : '' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <!-- Totales al final -->
                <tfoot class="sticky bottom-0 bg-yellow-200 font-bold">
                    <tr>
                        <td colspan="5" class="border border-yellow-400 px-2 py-2 text-right text-lg">TOTALES:</td>
                        <td class="border border-yellow-400 px-2 py-2 text-right text-blue-700">
                            $<?= number_format($totals['storage'], 2) ?>
                        </td>
                        <td class="border border-yellow-400 px-2 py-2 text-right text-green-700">
                            $<?= number_format($totals['order'], 2) ?>
                        </td>
                        <td colspan="4" class="border border-yellow-400 px-2 py-2"></td>
                        <td class="border border-yellow-400 px-2 py-2 text-right text-purple-700">
                            $<?= number_format($totals['prestige'], 2) ?>
                        </td>
                    </tr>
                    <tr class="bg-yellow-300">
                        <td colspan="5" class="border border-yellow-500 px-2 py-3 text-right text-xl">
                            💰 COSTO TOTAL:
                        </td>
                        <td colspan="7" class="border border-yellow-500 px-2 py-3 text-right text-2xl text-red-700">
                            $<?= number_format($totals['total'], 2) ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Información adicional -->
    <div class="mt-6 bg-gray-100 rounded-lg p-4 text-sm text-gray-700">
        <p class="mb-2"><strong>📌 Leyenda de colores:</strong></p>
        <ul class="list-disc list-inside space-y-1">
            <li><span class="inline-block w-4 h-4 bg-red-100 border border-red-300"></span> Inventario negativo (faltante)</li>
            <li><span class="inline-block w-4 h-4 bg-orange-100 border border-orange-300"></span> Se realizó pedido</li>
            <li><span class="inline-block w-4 h-4 bg-blue-100 border border-blue-300"></span> Cuenta regresiva de pedido activa</li>
            <li><span class="inline-block w-4 h-4 bg-red-200 border border-red-400"></span> Costo de pérdida de prestigio</li>
        </ul>
    </div>

    <!-- Botón para nueva simulación -->
    <div class="mt-6 flex justify-center">
        <a href="/inventory"
            class="bg-gradient-to-r from-gray-600 to-gray-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:from-gray-700 hover:to-gray-800 transform hover:scale-105 transition-all duration-200">
            🔄 Nueva Simulación
        </a>
    </div>
</div>