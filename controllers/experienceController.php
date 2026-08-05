<?php
defined('APP_RUNNING') || abort(403);
require_once ROOT_DIR . '/model/experiences.php';

function experience()
{
    setLayout('dashboard');
    return renderView('dashboard/experience/index', [
        'data' => getAllExperience(),
    ]);
}

function create()
{
    setLayout('dashboard');
    return renderView('dashboard/experience/create');
}

function handleCreate()
{
    verifyCsrf();
    $_SESSION['error'] = [];

    $position     = trim($_POST['position'] ?? '');
    $companyName  = trim($_POST['company_name'] ?? '');
    $location     = trim($_POST['location'] ?? '');
    $startDate    = trim($_POST['start_date'] ?? '');
    $description  = trim($_POST['description'] ?? '');
    $stillWorking = isset($_POST['still_working']);
    $endDate      = $stillWorking ? null : trim($_POST['end_date'] ?? '');

    $_SESSION['old']['position']     = $position;
    $_SESSION['old']['company_name'] = $companyName;
    $_SESSION['old']['location']     = $location;
    $_SESSION['old']['start_date']   = $startDate;
    $_SESSION['old']['description']  = $description;
    $_SESSION['old']['end_date']     = $endDate;

    validateString('position', $position, 'Posisi tidak boleh kosong!');
    validateString('company_name', $companyName, 'Nama perusahaan tidak boleh kosong!');
    validateString('location', $location, 'Lokasi perusahaan tidak boleh kosong!');
    validateString('description', $description, 'Keterangan tidak boleh kosong!');

    if ($startDate === '') {
        $_SESSION['error']['start_date'] = 'Tanggal mulai kerja tidak boleh kosong!';
    }

    if (! $stillWorking) {
        validateString('end_date', $endDate, 'Selesai kerja wajib diisi (atau centang "masih bekerja di sini")!');
    }

    if ($startDate !== '' && ! empty($endDate) && $endDate < $startDate) {
        $_SESSION['error']['end_date'] = 'Tanggal selesai tidak boleh sebelum tanggal mulai!';
    }

    if (! empty($_SESSION['error'])) {
        redirect('/dashboard/experience/create');
    }

    if (addExperience($position, $companyName, $location, $description, $startDate, $endDate)) {
        $_SESSION['alert']['success'] = 'Experience berhasil ditambahkan.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, Experience gagal ditambahkan.';
    }

    redirect('/dashboard/experience');
}

function edit()
{
    $rawId = query('id', '');
    $id    = decodeId($rawId);

    if ($id === 0) {
        redirect('/dashboard/experience');
    }

    $oldData = getExperienceById($id);

    if (! $oldData) {
        abort(404);
    }

    setLayout('dashboard');

    return renderView('dashboard/experience/edit', [
        'experience' => $oldData,
    ]);
}

function handleEdit()
{
    verifyCsrf();
    $_SESSION['error'] = [];

    $id           = trim($_POST['id'] ?? '');
    $position     = trim($_POST['position'] ?? '');
    $companyName  = trim($_POST['company_name'] ?? '');
    $location     = trim($_POST['location'] ?? '');
    $startDate    = trim($_POST['start_date'] ?? '');
    $description  = trim($_POST['description'] ?? '');
    $stillWorking = isset($_POST['still_working']);
    $endDate      = $stillWorking ? null : trim($_POST['end_date'] ?? '');

    if ($startDate === '') {
        $_SESSION['error']['start_date'] = 'Tanggal mulai kerja tidak boleh kosong!';
    }

    if (! $stillWorking) {
        validateString('end_date', $endDate, 'Selesai kerja wajib diisi (atau centang "masih bekerja di sini")!');
    }

    if ($startDate !== '' && ! empty($endDate) && $endDate < $startDate) {
        $_SESSION['error']['end_date'] = 'Tanggal selesai tidak boleh sebelum tanggal mulai!';
    }

    if (! empty($_SESSION['error'])) {
        redirect('/dashboard/experience/edit?id=' . encodeId($id));
    }

    if (updateExperience($id, $position, $companyName, $location, $description, $startDate, $endDate)) {
        $_SESSION['alert']['success'] = 'Experience ' . $position . ' berhasil di ubah.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, Experience ' . $position . ' gagal di ubah.';
    }

    redirect('/dashboard/experience');
}

function delete()
{
    verifyCsrf();

    $id = (int) ($_POST['id'] ?? 0);

    if (empty($id)) {
        redirect('/dashboard/experience');
    }

    $experience = getExperienceById($id);

    if (! $experience) {
        abort(404);
    }

    $position = $experience['position'];

    if (deleteExperience($experience['id'])) {
        $_SESSION['alert']['success'] = 'Experience ' . $position . ' berhasil di hapus.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, Experience ' . $position . ' gagal di hapus.';
    }

    redirect('/dashboard/experience');

}
