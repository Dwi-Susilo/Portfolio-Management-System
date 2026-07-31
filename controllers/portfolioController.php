<?php
defined('APP_RUNNING') || abort(403);
require_once ROOT_DIR . '/model/portfolios.php';

function portfolio()
{

    setLayout('dashboard');
    return renderView('dashboard/portfolio/index', [
        'portfolios' => getAllPortfolio(),
    ]);
}

function create()
{
    setLayout('dashboard');
    return renderView('dashboard/portfolio/create');
}

function edit()
{
    setLayout('dashboard');

    $rawId = query('id', '');

    $id = decodeId($rawId);

    if ($id === 0) {
        redirect('/dashboard/portfolio');
    }

    $portfolio = getPortfolioById($id);

    if (! $portfolio) {
        abort(404);
    }

    return renderView('dashboard/portfolio/edit', [
        'portfolio' => $portfolio,
    ]);
}
