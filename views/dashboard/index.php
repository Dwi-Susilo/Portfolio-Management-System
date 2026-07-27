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
      <h1 class="text-title">DASHBOARD</h1>
    </div>
  </header>

  <!-- SIDEBAR -->
   <?php require_once 'layouts/sidebar.php'; ?>

  <!-- MAIN -->
  <main class="main">
    <div class="container">
      <div class="row mt-3">
        <div class="col-md-3">
          <div class="card stat-card shadow-sm p-3">
            <i class="bi bi-briefcase"></i>
            <div class="">
              <p class="">3</p>
              <small class="">Portfolios</small>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stat-card shadow-sm p-3">
            <i class="bi bi-lightning"></i>
            <div class="">
              <p class="">3</p>
              <small class="">Total Skills</small>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stat-card shadow-sm p-3">
            <i class="bi bi-mortarboard"></i>
            <div class="">
              <p class="">3</p>
              <small class="">Education</small>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stat-card shadow-sm p-3">
            <i class="bi bi-chat-dots"></i>
            <div class="">
              <p class="">1</p>
              <small class=""> Unread Messages </small>
            </div>
          </div>
        </div>
      </div>
    </div>
    </main>
