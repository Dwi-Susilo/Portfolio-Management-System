<?php
defined('APP_RUNNING') || abort(403);

$routes   = [];
$callback = false;

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

function setCallback($method, $path)
{
    global $callback;
    global $routes;

    $callback = $routes[$method][$path] ?? false;
}

function getCallback()
{
    global $callback;
    return $callback;
}

function resolve()
{
    // global $routes;

    $path   = getPath();
    $method = method();

    setCallback(method(), getPath());

    // $callback = $routes[$method][$path] ?? false;
    $callback = getCallback();

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

            abort(500, '$file = ' . $file . ' - tidak ditemukan!');
        }

        require_once $file;

        if (! function_exists($function)) {

            abort(500, '$function = ' . $function . ' - tidak ditemukan!');
        }

        $callback = $function;
    }

    return call_user_func($callback);
}
