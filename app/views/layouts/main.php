<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $metaDescription ?? 'Mi Aplicación Web' ?>">
    <title><?= $title ?? 'Mi Aplicación' ?></title>
    <link rel="stylesheet" href="/styles/main.css">
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <div class="flex flex-col min-h-screen">
        <header class="bg-white shadow-md">
            <nav class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <div class="text-2xl font-bold text-blue-600">🚀 MiApp</div>
                    <ul class="flex space-x-6">
                        <li><a href="/" class="text-gray-700 hover:text-blue-600 transition-colors">Inicio</a></li>
                        <li><a href="/about" class="text-gray-700 hover:text-blue-600 transition-colors">Acerca de</a></li>
                        <li><a href="/api/data" class="text-gray-700 hover:text-blue-600 transition-colors">API</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <main class="flex-grow container mx-auto px-4 py-8">
            <?= $content ?>
        </main>

        <footer class="bg-gray-800 text-white py-6 mt-auto">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; <?= date('Y') ?> Mi Aplicación Web | Desarrollado con ❤️ usando PHP</p>
            </div>
        </footer>
    </div>
</body>

</html>