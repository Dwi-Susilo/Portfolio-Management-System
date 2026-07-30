<div class="bg" style="background-color: black; position: absolute; top: 0; width: 100%; height: 100%; z-index: -100; " ></div>

<div style="text-align: center; margin-top: 50px; font-family: sans-serif;">
    <h1 class="text-danger" style="font-size: 100px; font-weight: 600; letter-spacing: 10px;"><?php echo http_response_code(); ?></h1>
    <h3 class="mb-3 text-light"><?php echo $message ?></h3>

    <p class="text-light text-center">
        Sorry, the page you are trying to access
        cannot be displayed.
    </p>

    <?php if (! empty($debug)): ?>
        <div style="background: #2d2d2d; color: #ff6b6b; padding: 12px; margin-top: 15px; border-radius: 6px; font-family: monospace;">
            <strong>Debug Exception:</strong> <?php echo htmlspecialchars($debug); ?>
        </div>
    <?php endif; ?>
</div>