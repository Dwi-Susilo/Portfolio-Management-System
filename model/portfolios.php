<?php
defined('APP_RUNNING') || exit(header('Location: /'));

function getAllPortfolio($conn)
{
    $stmt = mysqli_prepare($conn, "SELECT id, title, description, image, created_at FROM  portfolios ORDER BY created_at DESC");

}
