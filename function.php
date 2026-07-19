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

    require 'error.php';
    exit();
}

function routes() {
    $routes = [
        'GET' => [
            'home' => 'index.html',
            'login' => 'login.html',
            'register' => 'register.html',
            'dashboard' => 'dashboard.html'
        ]
    ];
    return $routes;
}