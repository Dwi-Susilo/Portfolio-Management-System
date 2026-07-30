<?php

$layout = 'main';
$title  = 'home';

function setLayout($layoutPath)
{
    global $layout;
    $layout = $layoutPath;
}

function setTitle($titlePath)
{
    global $title;
    $title = $titlePath;
}

function getTitle()
{
    global $title;
    return $title;
}

function render($view, $params = [])
{
    return renderView($view, $params);
}

function renderView($view, $params = [])
{
    $viewContent   = renderOnlyView($view, $params);
    $layoutContent = layoutContent();

    return str_replace('{{content}}', $viewContent, $layoutContent);
}

function renderContent($content)
{
    $layoutContent = layoutContent();

    return str_replace('{{content}}', $content, $layoutContent);
}

function layoutContent()
{
    global $layout;

    if (! $layout) {
        $layout = 'main';
    }

    ob_start();
    include_once ROOT_DIR . '/views/layouts/' . $layout . '.php';
    return ob_get_clean();
}

function renderOnlyView($view, $params = [])
{
    foreach ($params as $key => $value) {
        $$key = $value;
    }

    ob_start();
    include_once ROOT_DIR . '/views/' . $view . '.php';
    return ob_get_clean();
}
