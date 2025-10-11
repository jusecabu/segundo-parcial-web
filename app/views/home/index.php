<div class="text-3xl font-semibold text-gray-800 mb-6">
    <?= $greeting ?>
</div>

<div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg shadow-xl p-8 mb-8">
    <h1 class="text-4xl font-bold mb-4"><?= $siteInfo['title'] ?></h1>
    <p class="text-xl mb-2"><?= $siteInfo['subtitle'] ?></p>
    <p class="text-lg mb-4"><?= $siteInfo['description'] ?></p>
    <span class="inline-block bg-white text-blue-600 px-4 py-2 rounded-full text-sm font-semibold">
        v<?= $siteInfo['version'] ?>
    </span>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
    <?php foreach ($statistics as $stat): ?>
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow">
            <div class="text-4xl mb-3"><?= $stat['icon'] ?></div>
            <div class="text-3xl font-bold text-gray-800 mb-2"><?= $stat['formatted'] ?></div>
            <div class="text-gray-600"><?= $stat['label'] ?></div>
        </div>
    <?php endforeach; ?>
</div>

<section class="mb-12">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">🎯 Características Principales</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($features as $feature): ?>
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow border-t-4 border-blue-500">
                <div class="text-4xl mb-4"><?= $feature['icon'] ?></div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3"><?= $feature['title'] ?></h3>
                <p class="text-gray-600"><?= $feature['description'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>