<?php

date_default_timezone_set('America/Bogota');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/routes/index.php';

use Core\Application\App;


App::run();
