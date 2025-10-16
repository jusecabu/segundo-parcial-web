<div class="bg-blue-50 rounded-lg p-6 border-2 border-blue-200">
    <h3 class="text-xl font-bold mb-4 text-blue-800">📈 Probabilidades de Demanda Diaria</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-blue-200">
                    <th class="px-4 py-2 text-left">Unidades</th>
                    <th class="px-4 py-2 text-left">Probabilidad (%)</th>
                    <th class="px-4 py-2 text-left">Rango Mínimo</th>
                    <th class="px-4 py-2 text-left">Rango Máximo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($demand as $units => $info): ?>
                    <tr class="border-b border-blue-100">
                        <td class="px-4 py-2 font-semibold"><?= $units ?></td>
                        <td class="px-4 py-2">
                            <input type="number" name="demand_<?= $units ?>_prob" value="<?= $info['probability'] ?>"
                                class="w-20 px-2 py-1 border border-gray-300 rounded">
                        </td>
                        <td class="px-4 py-2">
                            <input type="number" step="0.01" name="demand_<?= $units ?>_min" value="<?= $info['range'][0] ?>"
                                class="w-24 px-2 py-1 border border-gray-300 rounded">
                        </td>
                        <td class="px-4 py-2">
                            <input type="number" step="0.01" name="demand_<?= $units ?>_max" value="<?= $info['range'][1] ?>"
                                class="w-24 px-2 py-1 border border-gray-300 rounded">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>