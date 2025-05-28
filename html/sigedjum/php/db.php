<?php
    // require_once '../env/secret.php';
    $DB_HOST = 'c282.ferozo.com';
    $DB_PORT = '2092';
    $DB_USER = 'c2821127';
    $DB_PASS = 'PUnuru87fi';
    $DB_NAME = 'c2821127_JURI_01';
    $DB_CHARSET = 'utf8mb4';
    try {
        $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
?>