<?php

$host     = '127.0.0.1';
$dbname   = 'db_latihan';
$user     = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
