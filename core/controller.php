<?php
defined('APP_RUNNING') || abort(403);

function run()
{
    try {
        echo resolve();
    } catch (\Throwable $e) {
        $code    = $e->getCode();
        $message = $e->getMessage();

        abort($code, $message);
    }

}

function isGuest()
{
    return empty($_SESSION['username']);
}
