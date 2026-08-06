<?php
defined('APP_RUNNING') || abort(403);

function setStatusCode($code)
{
    http_response_code($code);
}

function redirect($url)
{
    header("Location: $url");
    exit();
}

function abort($code = 500, $debugMessage = '')
{
    setStatusCode($code);

    $messages = [
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Page Not Found',
        500 => 'Internal Server Error',
    ];

    $debug = (APP_ENV === 'development') ? $debugMessage : null;

    $message = $messages[$code] ?? 'Unknown Error';

    echo renderView('_error', [
        'debug'   => $debug,
        'message' => $message,
        'code'    => $code,
    ]);
    exit();
}

function setFlash($type, $field)
{
    if (isset($_SESSION[$type][$field])) {
        $value = $_SESSION[$type][$field];
        unset($_SESSION[$type][$field]);
        return $value;
    }
    return null;
}

function hasFlash($type, $field)
{
    return isset($_SESSION[$type][$field]);
}

function getError($field)
{
    return setFlash('error', $field);
}

function getOld($field)
{
    return setFlash('old', $field);
}

function getAlert($status)
{
    return setFlash('alert', $status);
}

function clearFlashData()
{
    unset($_SESSION['error']);
    unset($_SESSION['old']);
}

function e($value)
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function eJs($value)
{
    return e(addslashes((string) ($value ?? '')));
}

function csrfToken()
{
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['_csrf_token'];
}

function csrfField()
{
    return '<input type="hidden" name="_csrf_token" value="' . e(csrfToken()) . '">';
}

function verifyCsrf()
{
    $token = $_POST['_csrf_token'] ?? '';

    if (empty($_SESSION['_csrf_token']) || ! hash_equals($_SESSION['_csrf_token'], $token)) {
        abort(403, 'Invalid CSRF token.');
    }
}
