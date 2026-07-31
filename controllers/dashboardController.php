<?php
defined('APP_RUNNING') || abort(403);

function dashboard()
{
    setLayout('dashboard');
    return renderView('dashboard/index');
}
