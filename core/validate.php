<?php
defined('APP_RUNNING') || abort(403);

function validateString($field, $value, $message)
{
    if (empty($value)) {
        $_SESSION['error'][$field] = $message;
        return false;
    }

    return true;
}
