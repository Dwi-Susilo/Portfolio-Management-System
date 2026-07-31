<?php
defined('APP_RUNNING') || exit(header('Location: /'));

function getUser()
{

}

function cekUser($column, $value)
{
    $sql  = "SELECT $column FROM users WHERE $column = ?";
    $stmt = mysqli_prepare(db(), $sql);

    mysqli_stmt_bind_param($stmt, 's', $value);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $user = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);
    return $user !== null;
}

function addUser($username, $email, $password)
{
    $password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare(db(), 'INSERT INTO users (username, password, email) VALUES (?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'sss', $username, $password, $email);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['alert']['success'] = 'Registrasi telah berhasil.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, registrasi telah gagal.';
    }

    mysqli_stmt_close($stmt);
    header('Location: /login');
    exit;

}

function updateUser()
{

}

function deleteUser()
{

}

function loginUser($username, $password, $remember = false)
{
    $stmt = mysqli_prepare(db(), 'SELECT id, username, password FROM users WHERE username = ?');
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $stmt = mysqli_prepare(db(), "UPDATE users SET last_login = NOW() WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $user['id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        session_regenerate_id(true);

        $_SESSION['isLogin']  = true;
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];

        if ($remember) {
            $token = bin2hex(random_bytes(32));

            $stmt = mysqli_prepare(db(), "UPDATE users SET remember_token = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "si", $token, $user['id']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            setcookie('remember_user', $user['id'] . ':' . $token, time() + (86400 * 7), '/', '', true, true);
        }

        header('Location: /dashboard');
        exit();
    }

    $_SESSION['error']['username'] = 'Username atau password salah.';

    header('Location: /login');
    exit();

}

function logOutUser($id)
{
    $stmt = mysqli_prepare(db(), "UPDATE users SET last_logout = NOW() WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if (isset($_COOKIE['remember_user'])) {
        setcookie('remember_user', '', time() - 3600, '/');
    }

}
