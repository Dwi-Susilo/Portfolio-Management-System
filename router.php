<?php
defined('APP_RUNNING') || abort(403);

function routes()
{
    $path = getPath();

    if (isGet()) {
        $viewPath = 'views/' . $path . '.php';

        $posisi = strpos($path, '/');

        if ($posisi === false && $path === 'dashboard') {
            $viewPath = 'views/' . $path . '/index.php';
        }

        // if (file_exists($viewPath)) {
        //     return $viewPath;
        // }

        $viewsDir     = realpath('views');
        $resolvedPath = realpath($viewPath);

        if ($viewsDir !== false && $resolvedPath !== false
            && strpos($resolvedPath, $viewsDir . DIRECTORY_SEPARATOR) === 0
            && is_file($resolvedPath)
        ) {
            return $resolvedPath;
        }

        abort(404);
    }

    if (isPost()) {
        if (function_exists('formHandling')) {
            formHandling($path);
            exit();

        }

        abort(404);
    }

    abort(404);
}
