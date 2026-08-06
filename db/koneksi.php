<?php

function db()
{
    static $conn = null;

    if ($conn === null) {
        $host     = getenv('DB_HOST') ?: '127.0.0.1';
        $dbname   = getenv('DB_NAME') ?: 'db_latihan';
        $user     = getenv('DB_USER') ?: 'root';
        $password = getenv('DB_PASSWORD') ?: '';

        try {
            $conn = new mysqli($host, $user, $password, $dbname);
        } catch (mysqli_sql_exception $e) {
            $debugMessage = (defined('APP_ENV') && APP_ENV === 'development')
                ? $e->getMessage() . ' (kode MySQL: ' . $e->getCode() . ')'
                : null;

            abort(500, $debugMessage);
        }
    }

    return $conn;
}

/**
 * Setup database & jalankan schema.sql kalau tabel belum ada.
 * SENGAJA hanya dipanggil manual/eksplisit, dan cuma jalan di development
 * — bukan bagian dari db(), supaya tiap request nggak nanggung query
 * ekstra buat cek schema, dan supaya nggak bisa "kebablasan" jalan
 * otomatis di production.
 */
function ensureDatabaseReady()
{
    if (! defined('APP_ENV') || APP_ENV !== 'development') {
        return;
    }

    $conn   = db();
    $dbname = getenv('DB_NAME') ?: 'db_latihan';

    $conn->query("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    $conn->select_db($dbname);

    $checkTable = $conn->query("SHOW TABLES LIKE 'users'");

    if ($checkTable && $checkTable->num_rows === 0) {
        $sqlFile = ROOT_DIR . '/database/schema.sql';

        if (file_exists($sqlFile)) {
            $conn->multi_query(file_get_contents($sqlFile));

            while ($conn->next_result()) {
                if (! $conn->more_results()) {
                    break;
                }
            }
        }
    }
}
