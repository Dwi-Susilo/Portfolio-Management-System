<?php
defined('APP_RUNNING') || abort(403);

$routes = [];

function get($path, $callback)
{
    global $routes;
    $routes['get'][$path] = $callback;
}

function post($path, $callback)
{
    global $routes;
    $routes['post'][$path] = $callback;

}

function resolve()
{
    global $routes;

    $path   = getPath();
    $method = method();

    $callback = $routes[$method][$path] ?? false;

    if ($callback === false) {
        abort(404);
    }

    if (is_string($callback)) {
        return $callback;
    }

    if (is_array($callback)) {
        $file     = $callback[0];
        $function = $callback[1];

        $title = strtoupper($function);
        setTitle($title);

        if (! file_exists($file)) {
            abort(500);
        }

        require_once $file;

        if (! function_exists($function)) {
            abort(500);
        }

        $callback = $function;
    }

    return call_user_func($callback);
}

get('/', [ROOT_DIR . '/controllers/siteController.php', 'home']);
post('/', [ROOT_DIR . '/controllers/siteController.php', 'contact']);

get('/login', [ROOT_DIR . '/controllers/authController.php', 'login']);
post('/login', [ROOT_DIR . '/controllers/authController.php', 'handleLogin']);

get('/register', [ROOT_DIR . '/controllers/authController.php', 'register']);
post('/register', [ROOT_DIR . '/controllers/authController.php', 'HandleRegister']);

get('/dashboard', [ROOT_DIR . '/controllers/authController.php', 'dashboard']);
get('/profile', [ROOT_DIR . '/controllers/authController.php', 'profile']);
get('/education', [ROOT_DIR . '/controllers/authController.php', 'education']);
get('/skills', [ROOT_DIR . '/controllers/authController.php', 'skills']);
get('/experience', [ROOT_DIR . '/controllers/authController.php', 'experience']);
get('/portoflio', [ROOT_DIR . '/controllers/authController.php', 'portfolio']);
get('/messages', [ROOT_DIR . '/controllers/authController.php', 'messages']);
get('/users', [ROOT_DIR . '/controllers/authController.php', 'users']);

post('/logout', [ROOT_DIR . '/core/controller.php', 'logout']);
