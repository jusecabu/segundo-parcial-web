<div class="bg-green-50 rounded-lg p-6 border-2 border-green-200">
    <h3 class="text-xl font-bold mb-4 text-green-800">📊 Parámetros del Inventario</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">R (Punto de Reorden)</label>
            <input type="number" name="R" value="<?= $inv['R'] ?>"
                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Q (Cantidad a Pedir)</label>
            <input type="number" name="Q" value="<?= $inv['Q'] ?>"
                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Inventario Inicial</label>
            <input type="number" name="initialInventory" value="<?= $inv['initialInventory'] ?>"
                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Costo Pérdida Prestigio/Unidad</label>
            <input type="number" name="prestigeLoss" value="<?= $inv['prestigeLossCostPerUndeliveredUnit'] ?>"
                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Costo de Pedido</label>
            <input type="number" name="orderCost" value="<?= $inv['orderPlacementCost'] ?>"
                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Costo Almacenamiento/Unidad/Día</label>
            <input type="number" name="storageCost" value="<?= $inv['unitStorageCostPerDay'] ?>"
                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none">
        </div>
    </div>
</div>