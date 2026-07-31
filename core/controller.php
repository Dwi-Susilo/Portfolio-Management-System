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
