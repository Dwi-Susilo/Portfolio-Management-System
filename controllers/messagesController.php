<?php
defined('APP_RUNNING') || abort(403);

function messages()
{
    setLayout('dashboard');
    return renderView('dashboard/messages/index');
}
