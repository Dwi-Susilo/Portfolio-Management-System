<?php
defined('APP_RUNNING') || abort(403);

function skills()
{
    setLayout('dashboard');
    return renderView('dashboard/skills/index');
}
