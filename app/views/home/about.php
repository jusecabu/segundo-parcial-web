<div class="bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-lg shadow-xl p-8 mb-8">
    <h1 class="text-4xl font-bold">📖 <?= $pageTitle ?></h1>
</div>

<div class="bg-white rounded-lg shadow-md p-8 mb-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">🎯 Nuestra Misión</h2>
    <p class="text-gray-700 leading-relaxed"><?= $aboutInfo['mission'] ?></p>
</div>

<div class="bg-white rounded-lg shadow-md p-8 mb-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">🔭 Nuestra Visión</h2>
    <p class="text-gray-700 leading-relaxed"><?= $aboutInfo['vision'] ?></p>
</div>

<div class="bg-white rounded-lg shadow-md p-8 mb-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">💎 Nuestros Valores</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php foreach ($aboutInfo['values'] as $value): ?>
            <div class="flex items-center bg-gradient-to-r from-blue-50 to-purple-50 p-4 rounded-lg border-l-4 border-blue-500">
                <span class="text-gray-800">✨ <?= $value ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<section class="mb-12">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">👥 Nuestro Equipo</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($team as $member): ?>
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow border-t-4 border-purple-500">
                <h3 class="text-xl font-bold text-gray-800 mb-2"><?= $member['name'] ?></h3>
                <div class="text-purple-600 font-semibold mb-3"><?= $member['role'] ?></div>
                <p class="text-gray-600"><?= $member['description'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>