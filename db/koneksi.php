<?php
require_once __DIR__ . '/../function.php';

$host     = '127.0.0.1';
$dbname   = 'db_latihan';
$user     = 'root';
$password = '';

try {
    $conn = new mysqli($host, $user, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    $errorMessage = (APP_ENV === 'development') ? $e->getMessage() : null;
    abort(500, $errorMessage);
}
