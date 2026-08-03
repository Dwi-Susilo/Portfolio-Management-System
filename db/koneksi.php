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
            // 1. Koneksi ke MySQL server
            $conn = new mysqli($host, $user, $password);

            // 2. Buat database jika belum ada
            $conn->query("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
            $conn->select_db($dbname);

            // 3. Cek apakah tabel 'users' sudah ada
            $checkTable = $conn->query("SHOW TABLES LIKE 'users'");

            // Jika tabel belum ada, eksekusi schema.sql otomatis
            if ($checkTable && $checkTable->num_rows === 0) {
                $sqlFile = ROOT_DIR . '/database/schema.sql';
                if (file_exists($sqlFile)) {
                    $sql = file_get_contents($sqlFile);
                    $conn->multi_query($sql);

                    // Bersihkan hasil multi_query
                    while ($conn->next_result()) {
                        if (! $conn->more_results()) {
                            break;
                        }

                    }
                }
            }

        } catch (mysqli_sql_exception $e) {
            $errorMessage = (defined('APP_ENV') && APP_ENV === 'development') ? $e->getMessage() : null;
            abort(500, $errorMessage);
        }
    }

    return $conn;

}
