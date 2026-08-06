<?php
defined('APP_RUNNING') || abort(403);
require_once ROOT_DIR . '/model/skills.php';

function skills()
{
    setLayout('dashboard');
    return renderView('dashboard/skills/index', [
        'skills' => getAllSkills(),
    ]);
}

function create()
{
    setLayout('dashboard');
    return renderView('dashboard/skills/create');
}

function handleCreate()
{
    verifyCsrf();
    $_SESSION['error'] = [];

    $category          = trim($_POST['category'] ?? '');
    $icon_custom_value = trim($_POST['icon_custom_value'] ?? '');
    $icon              = $icon_custom_value ? null : trim($_POST['icon'] ?? '');
    $skills            = trim($_POST['skills'] ?? '');

    $_SESSION['old']['category']          = $category;
    $_SESSION['old']['icon_custom_value'] = $icon_custom_value;
    $_SESSION['old']['icon']              = $icon;
    $_SESSION['old']['skills']            = $skills;

    validateString('category', $category, 'Kategori tidak boleh kosong!');
    validateString('icon', $icon, 'Icon tidak boleh kosong!');
    validateString('skills', $skills, 'Skills tidak boleh kosong!');

    if (! empty($_SESSION['error'])) {
        redirect('/dashboard/skills/create');
    }

    if (addSkill($category, $icon, $skills)) {
        $_SESSION['alert']['success'] = 'Data berhasil ditambahkan.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, data baru gagal ditambahkan.';
    }

    redirect('/dashboard/skills');
}

function edit()
{
    $rawId = query('id', '');
    $id    = decodeId($rawId);

    if ($id === 0) {
        redirect('/dashboard/skills');
    }

    $oldData = getSkillById($id);

    if (! $oldData) {
        abort(404);
    }

    setLayout('dashboard');

    return renderView('dashboard/skills/edit', [
        'skill' => $oldData,
    ]);
}

function handleEdit()
{
    verifyCsrf();
    $_SESSION['error'] = [];

    $id                = trim($_POST['id'] ?? '');
    $category          = trim($_POST['category'] ?? '');
    $icon_custom_value = trim($_POST['icon_custom_value'] ?? '');
    $icon              = $icon_custom_value ? null : trim($_POST['icon'] ?? '');
    $skills            = trim($_POST['skills'] ?? '');

    validateString('category', $category, 'Kategori tidak boleh kosong!');
    validateString('icon', $icon, 'Icon tidak boleh kosong!');
    validateString('skills', $skills, 'Skills tidak boleh kosong!');

    if (! empty($_SESSION['error'])) {
        redirect('/dashboard/skills/edit?id=' . encodeId($id));
    }

    if (updateSkill($id, $category, $icon, $skills)) {
        $_SESSION['alert']['success'] = 'Data ' . $category . ' berhasil di ubah.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, ' . $category . ' gagal di ubah.';
    }

    redirect('/dashboard/skills');
}

function delete()
{
    verifyCsrf();

    $id = (int) ($_POST['id'] ?? 0);

    if (empty($id)) {
        redirect('/dashboard/skills');
    }

    $skill = getSkillById($id);

    if (! $skill) {
        abort(404);
    }

    if (deleteSkill($skill['id'])) {
        $_SESSION['alert']['success'] = 'Data ' . $skill['category'] . ' berhasil di hapus.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, data ' . $skill['category'] . ' gagal di hapus.';
    }

    redirect('/dashboard/skills');
}
