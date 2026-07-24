<?php
defined('APP_RUNNING') || exit(header('Location: /'));

function getUser()
{

}

function cekUser($conn, $column, $value)
{
    $sql  = "SELECT $column FROM users WHERE $column = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, 's', $value);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $user = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);
    return $user !== null;
}

function addUser($conn, $username, $email, $password)
{
    $password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($conn, 'INSERT INTO users (username, password, email) VALUES (?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'sss', $username, $password, $email);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['alert']['success'] = 'Registrasi telah berhasil.';

        mysqli_stmt_close($stmt);
        header('Location: /login');
        exit;
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, registrasi telah gagal.';

        mysqli_stmt_close($stmt);
        return;
    }

}

function updateUser()
{

}

function deleteUser()
{

}

function loginUser($conn, $username, $password, $remember = false)
{
    $stmt = mysqli_prepare($conn, 'SELECT id, username, password FROM users WHERE username = ?');
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $stmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $stmt->bind_param("i", $user['id']);
            $stmt->execute();
            $stmt->close();

            $_SESSION['isLogin']  = true;
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];

            if ($remember) {
                setcookie('remember_user', $user['username'], time() + (86400 * 7), '/');
            }

            header('Location: /dashboard');
            exit();
        } else {
            $_SESSION['error']['password'] = 'Password salah.';

            header('Location: /login');
            exit();
        }
    }

}

function logoutUser($conn, $id)
{
    $stmt = $conn->prepare("UPDATE users SET last_logout = NOW() WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

}
