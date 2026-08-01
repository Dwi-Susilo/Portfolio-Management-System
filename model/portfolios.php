<?php
defined('APP_RUNNING') || exit(header('Location: /'));

function getAllPortfolio()
{
    $stmt = mysqli_prepare(db(), "SELECT id, title, description, image, created_at FROM  portfolios ORDER BY created_at DESC");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $portfolios = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);

    return $portfolios;

}

function getPortfolioById($id)
{
    $stmt = mysqli_prepare(db(), "SELECT id, title, description, image FROM portfolios WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $portfolio = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $portfolio;

}

function addPortfolio($image, $title, $description)
{
    $stmt = mysqli_prepare(db(), "INSERT INTO portfolios (image, title, description) VALUES (?,?,?) ");
    mysqli_stmt_bind_param($stmt, "sss", $image, $title, $description);

    return mysqli_stmt_execute($stmt);
}
