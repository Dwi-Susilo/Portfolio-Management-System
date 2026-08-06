<?php
defined('APP_RUNNING') || abort(403);
require_once ROOT_DIR . '/model/messages.php';

function messages()
{
    setLayout('dashboard');
    return renderView('dashboard/messages/index', [
        'messages' => getAllMessages(),
    ]);
}

function show()
{
    $rawId = query('id', '');
    $id    = decodeId($rawId);

    if ($id === 0) {
        redirect(getPath());
    }

    $messageData = getMessageById($id);

    if (! $messageData) {
        abort(404);
    }

    if ($messageData['is_read'] == 0) {
        markAsRead($id);
    }

    setLayout('dashboard');

    return renderView(getPath() . '/show', [
        'message' => $messageData,
    ]);
}

function delete()
{
    verifyCsrf();

    $id = (int) ($_POST['id'] ?? 0);

    if (empty($id)) {
        redirect(getPath());
    }

    $messageData = getMessageById($id);

    if (! $messageData) {
        abort(404);
    }

    if (deleteMessage($messageData['id'])) {
        $_SESSION['alert']['success'] = 'Pesan dari ' . $messageData['name'] . ' berhasil dihapus.';
    } else {
        $_SESSION['alert']['danger'] = 'Terjadi kesalahan, pesan gagal dihapus.';
    }

    redirect(getPath());
}
