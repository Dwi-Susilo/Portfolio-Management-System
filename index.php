<?php 
require_once 'function.php';

$url = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
$url = $url?: 'home';

$routes = routes();

if (!isset($routes[$_SERVER['REQUEST_METHOD']][$url])) {
    abort(404);
}

$file = $routes[$_SERVER['REQUEST_METHOD']][$url];
require $file;
    



