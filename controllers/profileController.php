<?php
defined('APP_RUNNING') || abort(403);

function profile()
{
    setLayout('dashboard');
    return renderView('dashboard/profile/index');
}
