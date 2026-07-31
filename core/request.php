<?php
defined('APP_RUNNING') || abort(403);

function getPath()
{
    $path   = $_SERVER['REQUEST_URI'] ?? '/';
    $posisi = strpos($path, '?');

    if ($posisi !== false) {
        $path = substr($path, 0, $posisi);
    }

    return $path;

}

function methodPath()
{
    $path = explode('/', getPath());

    if (! isset($path[1])) {
        return $path = $path[0];
    }

    return $path = $path[1];
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

function query($key, $default = null)
{
    return $_GET[$key] ?? $default;
}

function encodeId($id)
{
    if (! is_numeric($id) || $id <= 0) {
        return '';
    }

    $salt     = 849201;
    $obscured = ($id * 15823) + $salt;

    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode((string) $obscured));

}

function decodeId($code)
{
    if (empty($code)) {
        return 0;
    }

    $code    = str_replace(['-', '_'], ['+', '/'], $code);
    $decoded = base64_decode($code);

    if (! is_numeric($decoded)) {
        return 0;
    }

    $salt = 849201;
    $id   = ((int) $decoded - $salt) / 15823;

    return (is_int($id) && $id > 0) ? $id : 0;
}
