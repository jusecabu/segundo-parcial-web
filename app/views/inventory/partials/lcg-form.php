<div class="bg-white rounded-lg p-4 border border-yellow-300">
    <h4 class="font-bold mb-3 text-yellow-700"><?= $this->e($title) ?></h4>
    <div class="space-y-2">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">A</label>
            <input type="number" name="<?= $prefix ?>_A" value="<?= $values['A'] ?>"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">X0</label>
            <input type="number" name="<?= $prefix ?>_X0" value="<?= $values['X0'] ?>"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">B</label>
            <input type="number" name="<?= $prefix ?>_B" value="<?= $values['B'] ?>"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">N</label>
            <input type="number" name="<?= $prefix ?>_N" value="<?= $values['N'] ?>"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-500 focus:outline-none">
        </div>
    </div>
</div>