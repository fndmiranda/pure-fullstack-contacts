<?php

use App\Core\Application;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

require '../vendor/autoload.php';

require '../config/app.php';

if (APP_ENV == 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

(new Application())->run();