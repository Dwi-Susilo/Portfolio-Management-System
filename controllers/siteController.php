<?php
defined('APP_RUNNING') || abort(403);
require_once ROOT_DIR . '/model/portfolios.php';
require_once ROOT_DIR . '/model/experiences.php';
require_once ROOT_DIR . '/model/educations.php';

function home()
{
    return renderView('home', [
        'portfolios'  => getAllPortfolio(),
        'experiences' => getAllExperience(),
        'educations'  => getAllEducation(),
    ]);
}

function contact()
{
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    exit;
}
