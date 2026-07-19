<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dendy Novianto | <?= $url ?></title>

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <!-- Style -->
    <link rel="stylesheet" href="assets/css/<?= empty($url) ? "index": $url; ?>.css" />
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbarNav">