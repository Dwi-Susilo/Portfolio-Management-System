    <!-- Bootstrap 5 JS Bundle -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- Custom JS -->
    <?php if (getPath() === 'dashboard'): ?>
      <script src="assets/js/dashboard.js"></script>
    <?php else: ?>
      <script src="assets/js/index.js"></script>
    <?php endif; ?>
  </body>
</html>