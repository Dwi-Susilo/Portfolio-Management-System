<?php 
require_once 'function.php';
define('APP_RUNNING', true);

$url = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
$url = $url?: 'home';

$routes = routes($_SERVER['REQUEST_METHOD'], $url);

require_once 'layouts/header.php';
require $routes;
require_once 'layouts/footer.php';



