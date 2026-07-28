<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dendy Novianto | <?php echo getPath(); ?></title>

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/bootstrap.css" />
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <!-- Style -->
    <?php if (strpos(getPath(), 'dashboard') === 0): ?>
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/dashboard.css" />
      </head>
      <body>

      <?php
          if (empty($_SESSION['isLogin'])) {
              exit(header('Location: /'));
          }
      ?>

      <img src="<?php echo BASE_URL ?>/assets/img/dashboard.jpg" alt="img" class="img-bg" />
      <div class="pulse"></div>

      <!-- SIDEBAR -->
      <?php require_once 'layouts/sidebar.php'; ?>

    <?php else: ?>
        <link rel="stylesheet" href="assets/css/<?php echo empty(getPath()) ? "index" : getPath(); ?>.css" />
      </head>
      <body data-bs-spy="scroll" data-bs-target="#navbarNav">
    <?php endif; ?>