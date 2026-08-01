<?php
session_start();

define('APP_ENV', 'development');
define('APP_RUNNING', true);
define('ROOT_DIR', dirname(__DIR__));

$scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
define('BASE_URL', $scheme . '://' . $_SERVER['HTTP_HOST']);

require_once ROOT_DIR . '/db/koneksi.php';

require_once ROOT_DIR . '/core/response.php';
require_once ROOT_DIR . '/core/request.php';
require_once ROOT_DIR . '/core/view.php';
require_once ROOT_DIR . '/core/router.php';
require_once ROOT_DIR . '/routes/web.php';
require_once ROOT_DIR . '/core/controller.php';
require_once ROOT_DIR . '/core/validate.php';

run();
