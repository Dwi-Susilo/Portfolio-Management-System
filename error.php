<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= http_response_code(); ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">

    <h1 class="display-1 fw-bold">
        <?= http_response_code(); ?>
    </h1>

    <h3 class="mb-3"><?= $message ?></h3>

    <p class="text-muted text-center">
        Sorry, the page you are trying to access
        cannot be displayed.
    </p>

    <a href="/" class="btn btn-dark mt-4">
        <i class="bi bi-house"></i>
        Back to Homepage
    </a>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>