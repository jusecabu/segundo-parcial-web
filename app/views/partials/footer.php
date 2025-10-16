<footer class="bg-gray-800 text-white py-6 mt-auto">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <p class="text-lg font-semibold mb-2">Segundo Parcial - Programación Web</p>
            <p class="text-sm text-gray-400">
                Estudiantes:
                <?php foreach ($students as $index => $student): ?>
                    <?= $student['name'] ?> - Código <?= $student['code'] ?><?= $index < count($students) - 1 ? ' | ' : '' ?>
                <?php endforeach; ?>
            </p>
            <p class="text-sm text-gray-400 mt-2">
                &copy; <?= $year ?> | Universidad Libre - Cali | Facultad de Ingeniería
            </p>
        </div>
    </div>
</footer>