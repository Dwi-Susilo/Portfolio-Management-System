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

// function formHandling($path)
// {
//     switch ($path) {
//         case 'register':
//             register();
//             return true;

//         case 'login':
//             login();
//             return true;

//         case 'logout':
//             logout();
//             return true;

//         default:
//             return false;
//     }

// }
