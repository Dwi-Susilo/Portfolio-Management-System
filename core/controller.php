<?php
defined('APP_RUNNING') || abort(403);

function run()
{
    try {
        echo resolve();
    } catch (\Exception $e) {
        setStatusCode($e->getCode());
        echo renderView('_error', [
            'exception' => $e,
        ]);
    }

}

function isGuest()
{
    return empty($_SESSION['username']);
}

function logout()
{
    global $conn;

    verifyCsrf();

    if (! file_exists('model/users.php')) {
        abort(500);
    }

    require_once 'model/users.php';

    if (! empty($_SESSION['user_id'])) {
        logOutUser($conn, $_SESSION['user_id']);
    }

    $_SESSION = [];

    session_destroy();
    header('Location: /');
    exit();
}
