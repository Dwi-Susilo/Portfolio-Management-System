<!-- SIDEBAR -->
  <nav class="sidebar" id="sidebar">
    <div class="container">
      <div class="sidebar-logo">
        <i class="bi bi-robot"></i>
        <?php echo htmlspecialchars($_SESSION['username']) ?>
      </div>
      <div class="sidebar-content">
        <div class="sidebar-link">
          <a href="/dashboard/" class="link">
            <i class="bi bi-speedometer2"></i>
            Dashboard
          </a>
        </div>
        <div class="sidebar-link">
          <a href="/dashboard/profile" class="link">
            <i class="bi bi-person-square"></i>
            Profile
          </a>
        </div>
        <div class="sidebar-link">
          <a href="/dashboard/education" class="link">
            <i class="bi bi-bookmark-star"></i>
            Education
          </a>
        </div>
        <div class="sidebar-link">
          <a href="/dashboard/portfolio" class="link">
            <i class="bi bi-briefcase"></i>
            Portfolio
          </a>
        </div>
        <div class="sidebar-link">
          <a href="/dashboard/messages" class="link">
            <i class="bi bi-envelope"></i>
            Messages
          </a>
        </div>
        <div class="sidebar-link">
          <a href="/dashboard/settings" class="link">
            <i class="bi bi-gear"></i>
            Settings
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
