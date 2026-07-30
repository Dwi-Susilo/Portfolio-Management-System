<?php

function home()
{
    return renderView('home');
}

function contact()
{
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    exit;
}
