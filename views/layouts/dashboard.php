<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dendy Novianto | <?php echo getTitle(); ?></title>

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/bootstrap.css" />
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <!-- Style -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/dashboard.css" />
</head>
<body>
    <?php isGuest() ?? exit(header('Location: /')); ?>

    <img src="<?php echo BASE_URL ?>/assets/img/dashboard.jpg" alt="img" class="img-bg" />
    <div class="pulse"></div>

    <!-- SIDEBAR -->
    <nav class="sidebar" id="sidebar">
        <div class="container">
            <div class="sidebar-logo">
                <i class="bi bi-robot"></i>
                <?php echo htmlspecialchars($_SESSION['username']) ?>
            </div>
            <div class="sidebar-content">
                <div class="sidebar-link">
                    <a href="/dashboard" class="link">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </div>
                <div class="sidebar-link">
                    <a href="/profile" class="link">
                        <i class="bi bi-person-vcard"></i>
                        Profile
                    </a>
                </div>
                <div class="sidebar-link">
                    <a href="/education" class="link">
                        <i class="bi bi-mortarboard"></i>
                        Education
                    </a>
                </div>
                <div class="sidebar-link">
                    <a href="/skills" class="link">
                        <i class="bi bi-kanban"></i>
                        Skills
                    </a>
                </div>
                <div class="sidebar-link">
                    <a href="/experience" class="link">
                        <i class="bi bi-briefcase"></i>
                        Experience
                    </a>
                </div>
                <div class="sidebar-link">
                    <a href="/portfolio" class="link">
                        <i class="bi bi-grid-3x3-gap"></i>
                        Portfolio
                    </a>
                </div>
                <div class="sidebar-link">
                    <a href="/messages" class="link">
                        <i class="bi bi-envelope"></i>
                        Messages
                    </a>
                </div>
                <div class="sidebar-link">
                    <a href="/users" class="link">
                        <i class="bi bi-person-gear"></i>
                        Users
                    </a>
                </div>
                <div class="sidebar-link">
                    <a href="/" class="link">
                        <i class="bi bi-house"></i>
                        Back Home
                    </a>
                </div>
            </div>
            <form action="logout" method="post">
                <?php echo csrfField(); ?>
                <button type="submit" name="Logout" class="sidebar-logout"><i class="bi bi-box-arrow-left"></i> Logout</button>
            </form>
        </div>
    </nav>
    <div class="sidebar-box"></div>

    {{content}}

    <!-- Bootstrap 5 JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <script src="<?php echo BASE_URL ?>/assets/js/dashboard.js"></script>
  </body>
</html>