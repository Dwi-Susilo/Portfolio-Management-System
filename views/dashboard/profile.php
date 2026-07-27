<?php
    if (empty($_SESSION['isLogin'])) {
    exit(header('Location: /'));
    }

?>

<img src="<?php echo BASE_URL ?>/assets/img/dashboard.jpg" alt="img" class="img-bg" />
  <div class="pulse"></div>

  <!-- HEADER -->
  <header class="header">
    <div class="container">
      <h1 class="text-title">PROFILE</h1>
    </div>
  </header>

  <!-- SIDEBAR -->
   <?php require_once 'layouts/sidebar.php'; ?>