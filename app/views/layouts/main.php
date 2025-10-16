<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $metaDescription ?? 'Segundo Parcial - Programación Web' ?>">
    <title><?= $this->yield('pageTitle', $title ?? 'Simulación de Inventario') ?></title>
    <link rel="stylesheet" href="/styles/main.css">
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <div class="flex flex-col min-h-screen">

        <?= $this->include('partials/header', ['currentPath' => $_SERVER['REQUEST_URI']]); ?>

        <main class="flex-grow container mx-auto px-4 py-8">
            <?= $content ?>
        </main>

        <?= $this->include('partials/footer', [
            'year' => date('Y'),
            'students' => [
                ['name' => 'Juan Sebastian Castañeda Burbano', 'code' => '2316609'],
                ['name' => 'Daniel Steven Chaves Valdez', 'code' => 'XXXXXX'],
            ]
        ]) ?>
    </div>
</body>

</html>