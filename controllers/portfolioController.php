<?php
defined('APP_RUNNING') || abort(403);

function portfolio()
{
    global $conn;

    if (! file_exists(ROOT_DIR . "/model/portfolios.php")) {
        abort(500);
    }

    require_once ROOT_DIR . '/model/portfolios.php';

    setLayout('dashboard');
    return renderView('dashboard/portfolio/index', [
        'portfolios' => getAllPortfolio($conn),
    ]);
}

function create()
{

    return renderView('dashboard/portfolio/create');
}

function edit()
{
    global $conn;
    setLayout('dashboard');

    if (! file_exists(ROOT_DIR . "/model/portfolios.php")) {
        abort(500);
    }

    require_once ROOT_DIR . '/model/portfolios.php';

    $rawId = query('id', '');

    $id = decodeId($rawId);

    if ($id === 0) {
        redirect('/dashboard/portfolio');
    }

    $portfolio = getPortfolioById($conn, $id);

    if (! $portfolio) {
        abort(404);
    }

    return renderView('dashboard/portfolio/edit', [
        'portfolio' => $portfolio,
    ]);
}
