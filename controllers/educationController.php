<?php
defined('APP_RUNNING') || abort(403);

function education()
{
    setLayout('dashboard');
    return renderView('dashboard/education/index');
}
