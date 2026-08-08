<?php
defined('APP_RUNNING') || exit(header('Location: /'));

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

/**
 * Cek apakah $column bernilai $value itu milik user LAIN (bukan $excludeId).
 * Dipakai pas edit user, supaya user boleh "bentrok" sama datanya sendiri
 * (nggak diubah), tapi tetap ditolak kalau bentrok sama user lain.
 */
function cekUserExcept($column, $value, $excludeId)
{
    $sql  = "SELECT id FROM users WHERE $column = ? AND id != ?";
    $stmt = mysqli_prepare(db(), $sql);

    mysqli_stmt_bind_param($stmt, 'si', $value, $excludeId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user   = mysqli_fetch_assoc($result);

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
        $_SESSION['role']     = isSuperAdmin($user['id']) ? 'super_admin' : 'admin';

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

/**
 * Cek status super admin dari tabel TERPISAH (admin_roles), bukan dari
 * kolom di tabel users. Kehadiran baris di admin_roles = super admin;
 * nggak ada baris = admin biasa (default).
 */
function isSuperAdmin($userId)
{
    $stmt = mysqli_prepare(db(), "SELECT id FROM admin_roles WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row    = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);
    return $row !== null;
}

/**
 * Ambil semua user untuk halaman list dashboard. SENGAJA tidak
 * menyertakan kolom password. Role juga sengaja tidak diambil di sini
 * karena tidak ditampilkan di UI sama sekali.
 */
function getAllUsers()
{
    $stmt = mysqli_prepare(db(), "SELECT id, username, email, created_at, last_login, last_logout FROM users ORDER BY created_at DESC");
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $users  = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);

    return $users;
}

function getUserById($id)
{
    $stmt = mysqli_prepare(db(), "SELECT id, username, email, created_at, last_login FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user   = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $user;
}

/**
 * Tambah admin baru lewat dashboard. Selalu jadi role "admin" biasa
 * (tidak pernah ditulis ke admin_roles) - beda dari addUser() yang
 * dipakai untuk alur registrasi publik.
 */
function createAdminUser($username, $email, $password)
{
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare(db(), "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;
}

/**
 * Update user. $password bisa null (artinya password lama dipertahankan,
 * dipakai kalau admin edit tapi tidak mengisi field password baru).
 */
function updateUser($id, $username, $email, $password = null)
{
    if ($password !== null) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare(db(), "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $hashed, $id);
    } else {
        $stmt = mysqli_prepare(db(), "UPDATE users SET username = ?, email = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "ssi", $username, $email, $id);
    }

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;
}

/**
 * Hapus user. Kalau kebetulan dia super admin, baris di admin_roles
 * otomatis ikut kehapus lewat FOREIGN KEY ... ON DELETE CASCADE,
 * jadi tidak perlu dihapus manual di sini.
 */
function deleteUser($id)
{
    $stmt = mysqli_prepare(db(), "DELETE FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;
}
