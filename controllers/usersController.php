<?php
defined('APP_RUNNING') || abort(403);
require_once ROOT_DIR . '/model/users.php';

function users()
{
    setLayout('dashboard');
    return renderView('dashboard/users/index', [
        'users' => getAllUsers(),
    ]);
}

function create()
{
    setLayout('dashboard');
    return renderView('dashboard/users/create');
}

function handleCreate()
{
    verifyCsrf();
    $_SESSION['error'] = [];

    $username  = trim($_POST['username'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $cpassword = $_POST['cpassword'] ?? '';

    $_SESSION['old']['username'] = $username;
    $_SESSION['old']['email']    = $email;

    validateString('username', $username, 'Username tidak boleh kosong!');
    validateString('email', $email, 'Email tidak boleh kosong!');
    validateString('password', $password, 'Password tidak boleh kosong!');

    if ($username !== '') {
        if (strlen($username) > 24) {
            $_SESSION['error']['username'] = 'Maksimal 24 karakter!';
        } elseif (cekUser('username', $username)) {
            $_SESSION['error']['username'] = 'Username sudah digunakan.';
        }
    }

    if ($email !== '') {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']['email'] = 'Format email tidak valid!';
        } elseif (cekUser('email', $email)) {
            $_SESSION['error']['email'] = 'Email sudah digunakan.';
        }
    }

    if ($password !== '') {
        if (strlen($password) < 6) {
            $_SESSION['error']['password'] = 'Minimal 6 karakter!';
        } elseif ($cpassword !== $password) {
            $_SESSION['error']['cpassword'] = 'Konfirmasi password tidak cocok!';
        }
    }

    if (! empty($_SESSION['error'])) {
        redirect('/dashboard/users/create');
    }

    if (createAdminUser($username, $email, $password)) {
        $_SESSION['alert']['success'] = 'User ' . $username . ' berhasil ditambahkan.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, user gagal ditambahkan.';
    }

    redirect('/dashboard/users');
}

function edit()
{
    $rawId = query('id', '');
    $id    = decodeId($rawId);

    if ($id === 0) {
        redirect('/dashboard/users');
    }

    $userData = getUserById($id);

    if (! $userData) {
        abort(404);
    }

    setLayout('dashboard');

    return renderView('dashboard/users/edit', [
        'user' => $userData,
    ]);
}

function handleEdit()
{
    verifyCsrf();
    $_SESSION['error'] = [];

    $id        = (int) ($_POST['id'] ?? 0);
    $username  = trim($_POST['username'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $cpassword = $_POST['cpassword'] ?? '';

    if ($id <= 0 || ! getUserById($id)) {
        abort(404);
    }

    validateString('username', $username, 'Username tidak boleh kosong!');
    validateString('email', $email, 'Email tidak boleh kosong!');

    if ($username !== '') {
        if (strlen($username) > 24) {
            $_SESSION['error']['username'] = 'Maksimal 24 karakter!';
        } elseif (cekUserExcept('username', $username, $id)) {
            $_SESSION['error']['username'] = 'Username sudah digunakan.';
        }
    }

    if ($email !== '') {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']['email'] = 'Format email tidak valid!';
        } elseif (cekUserExcept('email', $email, $id)) {
            $_SESSION['error']['email'] = 'Email sudah digunakan.';
        }
    }

    // Password OPSIONAL di form edit - kosong berarti "tidak diganti".
    // Kalau diisi, tetap divalidasi sama seperti create.
    if ($password !== '') {
        if (strlen($password) < 6) {
            $_SESSION['error']['password'] = 'Minimal 6 karakter!';
        } elseif ($cpassword !== $password) {
            $_SESSION['error']['cpassword'] = 'Konfirmasi password tidak cocok!';
        }
    }

    if (! empty($_SESSION['error'])) {
        redirect('/dashboard/users/edit?id=' . encodeId($id));
    }

    $passwordToSave = ($password !== '') ? $password : null;

    if (updateUser($id, $username, $email, $passwordToSave)) {
        $_SESSION['alert']['success'] = 'User ' . $username . ' berhasil diperbarui.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, user gagal diperbarui.';
    }

    redirect('/dashboard/users');
}

function delete()
{
    verifyCsrf();

    if (($_SESSION['role'] ?? null) !== 'super_admin') {
        // abort(403, 'Permintaan menghapus user ditolak!');
        $_SESSION['alert']['danger'] = 'AKSES DITOLAK! Anda tidak memiliki izin untuk menghapus user ini.';
        redirect('/dashboard/users');
    }

    $id = (int) ($_POST['id'] ?? 0);

    if ($id <= 0) {
        redirect('/dashboard/users');
    }

    if ($id === (int) $_SESSION['user_id']) {
        $_SESSION['alert']['danger'] = 'Tidak bisa menghapus akun sendiri.';
        redirect('/dashboard/users');
    }

    $userData = getUserById($id);

    if (! $userData) {
        abort(404);
    }

    if (deleteUser($userData['id'])) {
        $_SESSION['alert']['success'] = 'User ' . $userData['username'] . ' berhasil dihapus.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, user gagal dihapus.';
    }

    redirect('/dashboard/users');
}
