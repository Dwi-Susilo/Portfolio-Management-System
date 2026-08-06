<?php
defined('APP_RUNNING') || abort(403);
require_once ROOT_DIR . '/model/educations.php';

function education()
{
    setLayout('dashboard');
    return renderView('dashboard/education/index', [
        'educations' => getAllEducation(),
    ]);
}

function create()
{
    setLayout('dashboard');
    return renderView('dashboard/education/create');
}

function handleCreate()
{
    verifyCsrf();
    $_SESSION['error'] = [];

    $institutionName = trim($_POST['institution_name'] ?? '');
    $location        = trim($_POST['location'] ?? '');
    $startDate       = trim($_POST['start_date'] ?? '');
    $isCurrent       = isset($_POST['is_current']);
    $endDate         = $isCurrent ? null : trim($_POST['end_date'] ?? '');

    $_SESSION['old']['institution_name'] = $institutionName;
    $_SESSION['old']['location']         = $location;
    $_SESSION['old']['start_date']       = $startDate;
    $_SESSION['old']['is_current']       = $isCurrent;
    $_SESSION['old']['end_date']         = $endDate;

    validateString('institution_name', $institutionName, 'Nama intitusi tidak boleh kosong!');
    validateString('location', $location, 'Lokasi tidak boleh kosong!');

    if ($startDate === '') {
        $_SESSION['error']['start_date'] = 'Bagian ini tidak boleh kosong!';
    }

    if (! $isCurrent) {
        validateString('end_date', $endDate, 'Bagian ini wajib diisi (atau centang "jika masih")!');
    }

    if ($startDate !== '' && ! empty($endDate) && $endDate < $startDate) {
        $_SESSION['error']['end_date'] = 'Tanggal selesai tidak boleh sebelum tanggal mulai!';
    }

    if (! empty($_SESSION['error'])) {
        redirect('/dashboard/education/create');
    }

    if (addEducation($institutionName, $location, $startDate, $endDate)) {
        $_SESSION['alert']['success'] = 'Data Education berhasil ditambahkan.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, data Education gagal ditambahkan.';
    }

    redirect('/dashboard/education');
}

function edit()
{
    $rawId = query('id', '');
    $id    = decodeId($rawId);

    if ($id === 0) {
        redirect('/dashboard/education');
    }

    $oldData = getEducationById($id);

    if (! $oldData) {
        abort(404);
    }

    setLayout('dashboard');

    return renderView('dashboard/education/edit', [
        'education' => $oldData,
    ]);
}

function handleEdit()
{
    verifyCsrf();
    $_SESSION['error'] = [];

    $id              = trim($_POST['id'] ?? '');
    $institutionName = trim($_POST['institution_name'] ?? '');
    $location        = trim($_POST['location'] ?? '');
    $startDate       = trim($_POST['start_date'] ?? '');
    $isCurrent       = isset($_POST['is_current']);
    $endDate         = $isCurrent ? null : trim($_POST['end_date'] ?? '');

    $_SESSION['old']['institution_name'] = $institutionName;
    $_SESSION['old']['location']         = $location;
    $_SESSION['old']['start_date']       = $startDate;
    $_SESSION['old']['is_current']       = $isCurrent;
    $_SESSION['old']['end_date']         = $endDate;

    validateString('institution_name', $institutionName, 'Nama intitusi tidak boleh kosong!');
    validateString('location', $location, 'Lokasi tidak boleh kosong!');

    if ($startDate === '') {
        $_SESSION['error']['start_date'] = 'Bagian ini tidak boleh kosong!';
    }

    if (! $isCurrent) {
        validateString('end_date', $endDate, 'Bagian ini wajib diisi (atau centang "jika masih")!');
    }

    if ($startDate !== '' && ! empty($endDate) && $endDate < $startDate) {
        $_SESSION['error']['end_date'] = 'Tanggal selesai tidak boleh sebelum tanggal mulai!';
    }

    if (! empty($_SESSION['error'])) {
        redirect('/dashboard/education/edit?id=' . encodeId($id));
    }

    if (updateEducation($id, $institutionName, $location, $startDate, $endDate)) {
        $_SESSION['alert']['success'] = 'Data Education ' . $institutionName . ' berhasil di ubah.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, ' . $institutionName . ' gagal di ubah.';
    }

    redirect('/dashboard/education');
}

function delete()
{
    verifyCsrf();

    $id = (int) ($_POST['id'] ?? 0);

    if (empty($id)) {
        redirect('/dashboard/education');
    }

    $education = getEducationById($id);

    if (! $education) {
        abort(404);
    }

    $institutionName = $education['institution_name'];

    if (deleteEducation($education['id'])) {
        $_SESSION['alert']['success'] = 'Data Education ' . $institutionName . ' berhasil di hapus.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, data Education ' . $institutionName . ' gagal di hapus.';
    }

    redirect('/dashboard/education');

}
