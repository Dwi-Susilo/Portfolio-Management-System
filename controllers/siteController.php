<?php
defined('APP_RUNNING') || abort(403);
require_once ROOT_DIR . '/model/portfolios.php';
require_once ROOT_DIR . '/model/experiences.php';
require_once ROOT_DIR . '/model/educations.php';
require_once ROOT_DIR . '/model/skills.php';

function home()
{
    return renderView('home', [
        'portfolios'  => getAllPortfolio(),
        'experiences' => getAllExperience(),
        'educations'  => getAllEducation(),
        'skills'      => getAllSkills(),
    ]);
}

function contact()
{
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    exit;
}
