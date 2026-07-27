<?php
session_start();

define('APP_ENV', 'development');
define('APP_RUNNING', true);
define('BASE_URL', '');

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
