<?php
defined('APP_RUNNING') || abort(403);

function getPath()
{
    $path   = $_SERVER['REQUEST_URI'] ?? '/';
    $posisi = strpos($path, '?');

    if ($posisi !== false) {
        $path = substr($path, 0, $posisi);
    }

    $path = trim($path, '/') ?: 'home';

    $path = urldecode($path);

    if (! preg_match('#^[a-zA-Z0-9_\-]+(/[a-zA-Z0-9_\-]+)*$#', $path)) {
        abort(404);
    }

    if (strpos($path, '..') !== false) {
        abort(404);
    }

    return $path;

}

function method()
{
    return strtolower($_SERVER['REQUEST_METHOD']);
}

function isGet()
{
    return method() === 'get';
}

function isPost()
{
    return method() === 'post';
}

function formHandling($path)
{
    switch ($path) {
        case 'register':
            register();
            return true;

        case 'login':
            login();
            return true;

        case 'logout':
            logout();
            return true;

        default:
            return false;
    }

}
