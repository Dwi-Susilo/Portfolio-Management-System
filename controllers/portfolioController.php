<?php
defined('APP_RUNNING') || abort(403);
require_once ROOT_DIR . '/model/portfolios.php';

function portfolio()
{

    setLayout('dashboard');
    return renderView('dashboard/portfolio/index', [
        'portfolios' => getAllPortfolio(),
    ]);
}

function create()
{
    setLayout('dashboard');
    return renderView('dashboard/portfolio/create');
}

function handleCreate()
{
    verifyCsrf();
    $_SESSION['error'] = [];

    $title       = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $image       = validateImg();

    validateString('title', $title, 'Nama proyek tidak boleh kosong!');
    validateString('description', $description, 'Keterangan tidak boleh kosong!');

    if (! empty($_SESSION['error'])) {
        redirect('/dashboard/portfolio/create');
    }

    if (addPortfolio($image, $title, $description)) {
        $_SESSION['alert']['success'] = 'Portfolio berhasil ditambahkan.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, Portfolio gagal ditambahkan.';
    }

    redirect('/dashboard/portfolio');

}

function edit()
{

    $rawId = query('id', '');

    $id = decodeId($rawId);

    if ($id === 0) {
        redirect('/dashboard/portfolio');
    }

    $oldData = getPortfolioById($id);

    if (! $oldData) {
        abort(404);
    }

    $_SESSION['old']['image'] = $oldData['image'];

    setLayout('dashboard');

    return renderView('dashboard/portfolio/edit', [
        'portfolio' => $oldData,
    ]);
}

function handleEdit()
{
    verifyCsrf();
    $_SESSION['error'] = [];

    $id          = trim($_POST['id'] ?? '');
    $title       = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $image       = validateImg();

    validateString('title', $title, 'Nama proyek tidak boleh kosong!');
    validateString('description', $description, 'Keterangan tidak boleh kosong!');

    if (! empty($_SESSION['error'])) {
        redirect('/dashboard/portfolio/edit?id=' . encodeId($id));
    }

    if ($image === '') {
        $image = getOld('image');
    }

    if (updatePortfolio($image, $title, $description, $id)) {
        $_SESSION['alert']['success'] = 'Portfolio ' . $title . ' berhasil di ubah.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, Portfolio ' . $title . ' gagal di ubah.';
    }

    redirect('/dashboard/portfolio');

}

function delete()
{
    verifyCsrf();

    $id = (int) ($_POST['id'] ?? 0);

    if (empty($id)) {
        redirect('/dashboard/portfolio');
    }

    $portfolio = getPortfolioById($id);

    if (! $portfolio) {
        abort(404);
    }

    if (deletePortfolio($portfolio['id'])) {
        $imagePath = ROOT_DIR . '/public/assets/img/upload/portfolio/' . $portfolio['image'];

        if (is_file($imagePath)) {
            unlink($imagePath);
        }

        $_SESSION['alert']['success'] = 'Portfolio ' . $portfolio['title'] . ' berhasil di hapus.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, Portfolio ' . $portfolio['title'] . ' gagal di hapus.';
    }

    redirect('/dashboard/portfolio');
}

function validateImg()
{
    $newImg = trim($_FILES['image']['name'] ?? '');
    $image  = '';

    if ($newImg != '') {
        $img_tmp = $_FILES['image']['tmp_name'];
        $img_ext = strtolower(pathinfo($newImg, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($img_ext, $allowed)) {
            $unique_img = "portfolio_" . time() . "." . $img_ext;
            $uploadDir  = ROOT_DIR . "/public/assets/img/upload/portfolio/";

            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (! is_writeable($uploadDir)) {
                $_SESSION['error']['image'] = "Folder upload tidak bisa ditulisi. Cek izin folder: $uploadDir";

            } else {
                $path = $uploadDir . $unique_img;

                if (move_uploaded_file($img_tmp, $path)) {
                    $image = $unique_img;
                } else {
                    $_SESSION['error']['image'] = "Gagal menyimpan gambar (kode error: " . $_FILES['image']['error'] . ")";
                }
            }

        } else {
            $_SESSION['error']['image'] = "Format foto tidak didukung!";
        }
    }

    return $image;

}
