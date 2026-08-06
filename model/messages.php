<?php
defined('APP_RUNNING') || exit(header('Location: /'));

function getAllMessages()
{
    $stmt = mysqli_prepare(db(), "SELECT id, name, email, subject, message, is_read, created_at FROM messages ORDER BY created_at DESC");
    mysqli_stmt_execute($stmt);

    $result   = mysqli_stmt_get_result($stmt);
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);

    return $messages;
}

function getMessageById($id)
{
    $stmt = mysqli_prepare(db(), "SELECT * FROM messages WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $fetch  = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $fetch;
}

function addMessage($name, $email, $subject, $message)
{
    $stmt = mysqli_prepare(db(), "INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;
}

function deleteMessage($id)
{
    $stmt = mysqli_prepare(db(), "DELETE FROM messages WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;
}

function getUnreadMessagesCount()
{
    $stmt = mysqli_prepare(db(), "SELECT COUNT(id) AS total FROM messages WHERE is_read = 0");
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $fetch  = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $fetch['total'] ?? 0;
}

function markAsRead($id)
{
    $stmt = mysqli_prepare(db(), "UPDATE messages SET is_read = 1 WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;
}
