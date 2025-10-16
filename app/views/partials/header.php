<header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="text-2xl font-bold text-white flex items-center">
                📦 Sistema de Inventario
            </div>
            <ul class="flex space-x-6">
                <li>
                    <a href="/"
                        class="text-white hover:text-yellow-300 transition-colors font-semibold <?= $currentPath === '/' ? 'text-yellow-300' : '' ?>">
                        🏠 Inicio
                    </a>
                </li>
                <li>
                    <a href="/inventory"
                        class="text-white hover:text-yellow-300 transition-colors font-semibold <?= strpos($currentPath, '/inventory') === 0 ? 'text-yellow-300' : '' ?>">
                        📊 Simulación
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>