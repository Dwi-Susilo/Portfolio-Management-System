<?php
defined('APP_RUNNING') || abort(403);
require_once ROOT_DIR . '/model/portfolios.php';
require_once ROOT_DIR . '/model/experiences.php';
require_once ROOT_DIR . '/model/educations.php';
require_once ROOT_DIR . '/model/skills.php';
require_once ROOT_DIR . '/model/messages.php';

function home()
{
    return renderView('home', [
        'portfolios'  => getAllPortfolio(),
        'experiences' => getAllExperience(),
        'educations'  => getAllEducation(),
        'skills'      => getAllSkills(),
    ]);
}

function contact()
{
    verifyCsrf();
    $_SESSION['error'] = [];

    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $_SESSION['old']['name']    = $name;
    $_SESSION['old']['email']   = $email;
    $_SESSION['old']['subject'] = $subject;
    $_SESSION['old']['message'] = $message;

    validateString('name', $name, 'Nama tidak boleh kosong!');
    validateString('subject', $subject, 'Subjek tidak boleh kosong!');
    validateString('message', $message, 'Pesan tidak boleh kosong!');

    if (empty($email)) {
        $_SESSION['error']['email'] = 'Email tidak boleh kosong!';
    } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error']['email'] = 'Format email tidak valid!';
    }

    if (! empty($_SESSION['error'])) {
        redirect('/#contact');
    }

    if (addMessage($name, $email, $subject, $message)) {
        $_SESSION['alert']['success'] = 'Pesan Anda berhasil terkirim. Terima kasih!';
        unset($_SESSION['old']);
    } else {
        $_SESSION['alert']['danger'] = 'Gagal mengirim pesan. Silakan coba lagi nanti.';
    }

    redirect('/#contact');
}
