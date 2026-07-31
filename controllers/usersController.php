<?php
defined('APP_RUNNING') || abort(403);

function users()
{
    setLayout('dashboard');
    return renderView('dashboard/users/index');
}
