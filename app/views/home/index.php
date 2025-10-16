<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-lg shadow-xl p-12 mb-8 text-center">
    <h1 class="text-5xl font-bold mb-4"><?= $siteInfo['title'] ?></h1>
    <p class="text-2xl mb-2"><?= $siteInfo['subtitle'] ?></p>
    <p class="text-lg mb-6 opacity-90"><?= $siteInfo['description'] ?></p>
    <div class="flex justify-center items-center gap-4">
        <span class="inline-block bg-white text-blue-600 px-6 py-3 rounded-full text-lg font-semibold shadow-lg">
            v<?= $siteInfo['version'] ?>
        </span>
    </div>
</div>

<!-- Información del Proyecto -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <!-- Card Objetivo -->
    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center mb-4">
            <div class="bg-blue-100 rounded-full p-3 mr-4">
                <span class="text-3xl">🎯</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Objetivo</h2>
        </div>
        <p class="text-gray-600 leading-relaxed">
            Desarrollar una aplicación web en PHP que simule el comportamiento de un sistema de inventario,
            replicando exactamente los cálculos y resultados de una hoja de Excel.
        </p>
    </div>

    <!-- Card Tecnologías -->
    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center mb-4">
            <div class="bg-green-100 rounded-full p-3 mr-4">
                <span class="text-3xl">⚙️</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Tecnologías</h2>
        </div>
        <ul class="text-gray-600 space-y-2">
            <li>✅ PHP con Arquitectura MVC</li>
            <li>✅ Framework personalizado</li>
            <li>✅ TailwindCSS v4</li>
            <li>✅ Generadores Congruenciales Lineales</li>
        </ul>
    </div>
</div>

<!-- Características del Sistema -->
<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-blue-500 pb-2">
        📋 Características del Sistema de Inventario
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 border-l-4 border-blue-500">
            <h3 class="font-bold text-blue-800 mb-2">📦 Control de Inventario</h3>
            <p class="text-sm text-gray-700">Gestión automática con punto de reorden (R) y cantidad a pedir (Q)</p>
        </div>
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 border-l-4 border-green-500">
            <h3 class="font-bold text-green-800 mb-2">📊 Demanda Variable</h3>
            <p class="text-sm text-gray-700">Simulación de demanda diaria basada en probabilidades reales</p>
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 border-l-4 border-purple-500">
            <h3 class="font-bold text-purple-800 mb-2">🚚 Tiempo de Entrega</h3>
            <p class="text-sm text-gray-700">Simulación aleatoria del tiempo de llegada del proveedor</p>
        </div>
        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg p-4 border-l-4 border-yellow-500">
            <h3 class="font-bold text-yellow-800 mb-2">💰 Costos de Almacenamiento</h3>
            <p class="text-sm text-gray-700">Cálculo diario de costos por unidad almacenada</p>
        </div>
        <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 border-l-4 border-red-500">
            <h3 class="font-bold text-red-800 mb-2">⚠️ Pérdida de Prestigio</h3>
            <p class="text-sm text-gray-700">Penalización por unidades no entregadas a los clientes</p>
        </div>
        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-lg p-4 border-l-4 border-indigo-500">
            <h3 class="font-bold text-indigo-800 mb-2">🎲 Números Aleatorios</h3>
            <p class="text-sm text-gray-700">Generadores congruenciales lineales para la simulación</p>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="bg-gradient-to-r from-green-500 to-teal-600 text-white rounded-lg shadow-xl p-8 text-center">
    <h2 class="text-3xl font-bold mb-4">🚀 ¡Comienza la Simulación!</h2>
    <p class="text-lg mb-6">
        Calcula el comportamiento del inventario durante 1000 días con parámetros personalizables
    </p>
    <a href="/inventory"
        class="inline-block bg-white text-green-600 font-bold py-4 px-10 rounded-lg shadow-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-200">
        📊 Ir a la Simulación de Inventario
    </a>
</div>

<!-- Información Académica -->
<div class="mt-8 bg-gray-100 rounded-lg p-6 text-center">
    <p class="text-sm text-gray-600 mb-2">
        <strong>Universidad Libre - Cali</strong> | Facultad de Ingeniería
    </p>
    <p class="text-sm text-gray-600">
        Cátedra de Aplicaciones WEB | Octubre 2025
    </p>
</div>