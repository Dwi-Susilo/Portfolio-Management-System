<?php 

function abort(int $code) {
    http_response_code($code);

    $messages = [
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Page Not Found',
        500 => 'Internal Server Error'
    ];

    $message = $messages[$code] ?? 'Unknown Error';

    require 'views/error.php';
    exit();
}

function routes($method, $path) {
    $routes = [
        'GET' => [
            'home' => 'home',
            'login' => 'login',
            'register' => 'register',
            'dashboard' => 'dashboard'
        ]
    ];
    
    if (!isset($routes[$method][$path]) || !file_exists('views/'. $routes[$method][$path]. '.php')) {
        abort(404);
    }

    return 'views/'. $routes[$method][$path]. '.php';
}