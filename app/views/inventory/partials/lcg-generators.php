<div class="bg-yellow-50 rounded-lg p-6 border-2 border-yellow-200">
    <h3 class="text-xl font-bold mb-4 text-yellow-800">🎲 Generadores Congruenciales Lineales</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Generador 1 -->
        <?= $this->include('inventory/partials/lcg-form', [
            'title' => 'Generador 1 (Demanda)',
            'prefix' => 'lcg1',
            'values' => $lcg1
        ]) ?>

        <!-- Generador 2 -->
        <?= $this->include('inventory/partials/lcg-form', [
            'title' => 'Generador 2 (Tiempo de Entrega)',
            'prefix' => 'lcg2',
            'values' => $lcg2
        ]) ?>
    </div>
</div>