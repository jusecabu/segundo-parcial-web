<?php

date_default_timezone_set('America/Bogota');

require __DIR__ . '/../vendor/autoload.php';

use Core\Application\App;

require_once __DIR__ . '/../app/routes.php';

App::run();
