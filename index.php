<?php
session_start();
define('APP_RUNNING', true);

require_once 'db/koneksi.php';
require_once 'function.php';

$routes = routes();

require_once 'layouts/header.php';
require $routes;
clearFlashData();
require_once 'layouts/footer.php';
