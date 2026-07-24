    <!-- Bootstrap 5 JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <?php if (getPath() === 'dashboard'): ?>
      <script src="assets/js/dashboard.js"></script>
    <?php else: ?>
      <script src="assets/js/index.js"></script>
    <?php endif; ?>
  </body>
</html>