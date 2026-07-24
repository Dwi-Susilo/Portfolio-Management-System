<?php
session_start();
define('APP_ENV', 'development');
define('APP_RUNNING', true);

require_once 'function.php';
require_once 'db/koneksi.php';

$routes = routes();

require_once 'layouts/header.php';
require $routes;
clearFlashData();
require_once 'layouts/footer.php';
