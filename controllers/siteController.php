<?php
defined('APP_RUNNING') || abort(403);
require_once ROOT_DIR . '/model/portfolios.php';

function home()
{
    return renderView('home', [
        'portfolios' => getAllPortfolio(),
    ]);
}

function contact()
{
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    exit;
}
