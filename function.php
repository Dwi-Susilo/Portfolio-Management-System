<?php
defined('APP_RUNNING') || abort(403);

function abort($code = 500, $debugMessage = '')
{
    http_response_code($code);

    $messages = [
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Page Not Found',
        500 => 'Internal Server Error',
    ];

    $debug = (APP_ENV === 'development') ? $debugMessage : null;

    $message = $messages[$code] ?? 'Unknown Error';

    require 'views/error.php';
    exit();
}

function getPath()
{
    $path   = $_SERVER['REQUEST_URI'] ?? '/';
    $posisi = strpos($path, '?');

    if ($posisi !== false) {
        $path = substr($path, 0, $posisi);
    }

    return trim($path, '/') ?: 'home';
}

function routes()
{
    $path = getPath();

    if (isGet()) {
        $viewPath = 'views/' . $path . '.php';

        if (file_exists($viewPath)) {
            return $viewPath;
        }

        abort(404);
    }

    if (isPost()) {
        if (function_exists('formHandling')) {
            formHandling($path);
            exit();

        }

        abort(404);
    }

    abort(404);
}

function hasFlash($type, $field)
{
    return isset($_SESSION[$type][$field]);
}

function setFlash($type, $field)
{
    if (isset($_SESSION[$type][$field])) {
        $value = $_SESSION[$type][$field];
        unset($_SESSION[$type][$field]);
        return $value;
    }
    return null;
}

function getError($field)
{
    return setFlash('error', $field);
}

function getOld($field)
{
    return setFlash('old', $field);
}

function getAlert($status)
{
    return setFlash('alert', $status);
}

function clearFlashData()
{
    unset($_SESSION['error']);
    unset($_SESSION['old']);
}

function method()
{
    return strtolower($_SERVER['REQUEST_METHOD']);
}

function isGet()
{
    return method() === 'get';
}

function isPost()
{
    return method() === 'post';
}

function formHandling($path)
{
    if ($path === 'register') {
        register();
    }

    if ($path === 'login') {
        login();

    }

    if ($path === 'logout') {
        logout();

    }

}

function register()
{
    global $conn;

    if (! file_exists('model/users.php')) {
        abort(500);
    }

    require_once 'model/users.php';

    $username  = trim($_POST['username'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $cpassword = $_POST['cpassword'] ?? '';

    $_SESSION['error']           = [];
    $_SESSION['old']['username'] = $username;
    $_SESSION['old']['email']    = $email;

    if (empty($username)) {
        $_SESSION['error']['username'] = "Username tidak boleh kosong!";
    } elseif (strlen($username) > 24) {
        $_SESSION['error']['username'] = "Maximal 24 karakter!";
    } elseif (cekUser($conn, 'username', $username)) {
        $_SESSION['error']['username'] = 'Username sudah digunakan.';
    }

    if (empty($email)) {
        $_SESSION['error']['email'] = "Email tidak boleh kosong!";
    } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error']['email'] = "Email tidak valid!";
    } elseif (cekUser($conn, 'email', $email)) {
        $_SESSION['error']['email'] = 'Email sudah digunakan..';
    }

    if (empty($password)) {
        $_SESSION['error']['password'] = "Password tidak boleh kosong!";
    } elseif (strlen($password) < 6) {
        $_SESSION['error']['password'] = "Minimal 6 karakter!";
    } elseif ($cpassword !== $password) {
        $_SESSION['error']['cpassword'] = "Konfirmasi Password salah!";
    }

    if (! empty($_SESSION['error'])) {
        header('Location: /register');
        exit();
    }

    addUser($conn, $username, $email, $password);
}

function login()
{
    global $conn;

    if (! file_exists('model/users.php')) {
        abort(500);
    }

    require_once 'model/users.php';

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $remember = isset($_POST['remember']) ? $username : null;

    $_SESSION['error']           = [];
    $_SESSION['old']['username'] = $username;

    if (empty($username)) {
        $_SESSION['error']['username'] = "Username tidak boleh kosong!";
    } elseif (strlen($username) > 24) {
        $_SESSION['error']['username'] = "Maximal 24 karakter!";
    } elseif (! cekUser($conn, 'username', $username)) {
        $_SESSION['error']['username'] = 'Username tidak ditemukan.';
    }

    if (empty($password)) {
        $_SESSION['error']['password'] = "Password tidak boleh kosong!";
    }

    if (! empty($_SESSION['error'])) {
        header('Location: /login');
        exit();
    }

    loginUser($conn, $username, $password, $remember);

}

function logout()
{
    global $conn;

    if (! file_exists('model/users.php')) {
        abort(500);
    }

    require_once 'model/users.php';

    if (! empty($_SESSION['user_id'])) {
        logOutUser($conn, $_SESSION['user_id']);
    }

    $_SESSION = [];

    session_destroy();
    header('Location: /');
    exit();
}
