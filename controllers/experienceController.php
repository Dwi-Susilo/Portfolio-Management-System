<?php
defined('APP_RUNNING') || abort(403);

function experience()
{
    setLayout('dashboard');
    return renderView('dashboard/experience/index');
}
