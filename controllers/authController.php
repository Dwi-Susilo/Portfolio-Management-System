<?php
defined('APP_RUNNING') || abort(403);
require_once ROOT_DIR . '/model/users.php';

function login()
{
    setLayout('auth');
    return renderView('login');
}

function register()
{
    setLayout('auth');
    return renderView('register');
}

function handleLogin()
{
    verifyCsrf();

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $remember = isset($_POST['remember']) ? $username : null;

    $_SESSION['error']           = [];
    $_SESSION['old']['username'] = $username;

    if (empty($username)) {
        $_SESSION['error']['username'] = "Username tidak boleh kosong!";
    } elseif (strlen($username) > 24) {
        $_SESSION['error']['username'] = "Maximal 24 karakter!";
    } elseif (! cekUser('username', $username)) {
        $_SESSION['error']['username'] = 'Username atau password salah.';
    }

    if (empty($password)) {
        $_SESSION['error']['password'] = "Password tidak boleh kosong!";
    }

    if (! empty($_SESSION['error'])) {
        header('Location: /login');
        exit();
    }

    loginUser($username, $password, $remember);
}

function handleRegister()
{
    verifyCsrf();

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
    } elseif (cekUser('username', $username)) {
        $_SESSION['error']['username'] = 'Username sudah digunakan.';
    }

    if (empty($email)) {
        $_SESSION['error']['email'] = "Email tidak boleh kosong!";
    } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error']['email'] = "Email tidak valid!";
    } elseif (cekUser('email', $email)) {
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

    addUser($username, $email, $password);
}

function logout()
{
    verifyCsrf();

    if (! empty($_SESSION['user_id'])) {
        logOutUser($_SESSION['user_id']);
    }

    $_SESSION = [];

    session_destroy();
    header('Location: /');
    exit();
}
