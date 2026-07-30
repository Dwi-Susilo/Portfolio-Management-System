<?php
session_start();

define('APP_ENV', 'development');
define('APP_RUNNING', true);
define('ROOT_DIR', dirname(__DIR__));

$scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
define('BASE_URL', $scheme . '://' . $_SERVER['HTTP_HOST']);

require_once 'response.php';
require_once 'request.php';
require_once 'router.php';
require_once 'function.php';
require_once 'db/koneksi.php';

$routes = routes();

require_once 'layouts/header.php';
require $routes;

clearFlashData();

require_once 'layouts/footer.php';
