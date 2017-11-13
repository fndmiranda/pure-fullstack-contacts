<?php

/**
 * Environments
 */
define('APP_ENV', 'development');

/**
 * Paths
 */
define('BASE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('PUBLIC_PATH', BASE_PATH . 'public' . DIRECTORY_SEPARATOR);
define('PUBLIC_URL', '//' . $_SERVER['HTTP_HOST'] . str_replace(PUBLIC_PATH, '', dirname($_SERVER['SCRIPT_NAME'])));

/**
 * Database
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'pure-fullstack-contacts');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_CHARSET', 'utf8');