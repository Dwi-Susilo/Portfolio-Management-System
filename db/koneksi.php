<?php

function db()
{
    $host     = '127.0.0.1';
    $dbname   = 'db_latihan';
    $user     = 'root';
    $password = '';

    static $conn = null;

    if ($conn === null) {
        try {
            $conn = new mysqli($host, $user, $password, $dbname);
        } catch (mysqli_sql_exception $e) {
            $errorMessage = (APP_ENV === 'development') ? $e->getMessage() : null;
            abort(500, $errorMessage);
        }
    }

    return $conn;

}
