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

    $judul      = trim($_POST['judul'] ?? '');
    $deskripsi  = trim($_POST['deskripsi'] ?? '');
    $namaGambar = $_FILES['gambar']['name'];
    $gambar     = "";

    $_SESSION['error'] = [];

    if ($namaGambar != "") {
        $gambar_tmp = $_FILES['gambar']['tmp_name'];
        $gambar_ext = strtolower(pathinfo($namaGambar, PATHINFO_EXTENSION));
        $allowed    = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($gambar_ext, $allowed)) {
            $unique_img = "portfolio_" . time() . "." . $gambar_ext;
            $uploadDir  = ROOT_DIR . "/public/assets/img/upload/portfolio/";

            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (! is_writeable($uploadDir)) {
                $_SESSION['error']['gambar'] = "Folder upload tidak bisa ditulisi. Cek izin folder: $uploadDir";

            } else {
                $path = $uploadDir . $unique_img;

                if (move_uploaded_file($gambar_tmp, $path)) {
                    $gambar = $unique_img;
                } else {
                    $_SESSION['error']['gambar'] = "Gagal menyimpan gambar (kode error: " . $_FILES['gambar']['error'] . ")";
                }
            }

        } else {
            $_SESSION['error']['gambar'] = "Format foto tidak didukung!";
        }
    }

    if (! empty($_SESSION['error'])) {
        redirect('/dashboard/portfolio/create');
    }

    if (addPortfolio($gambar, $judul, $deskripsi)) {
        $_SESSION['alert']['success'] = 'Portfolio berhasil ditambahkan.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, Portfolio gagal ditambahkan.';
    }

    redirect('/dashboard/portfolio');

}

function edit()
{
    setLayout('dashboard');

    $rawId = query('id', '');

    $id = decodeId($rawId);

    if ($id === 0) {
        redirect('/dashboard/portfolio');
    }

    $portfolio = getPortfolioById($id);

    if (! $portfolio) {
        abort(404);
    }

    setLayout('dashboard');

    return renderView('dashboard/portfolio/edit', [
        'portfolio' => $portfolio,
    ]);
}
