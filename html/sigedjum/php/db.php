<?php
    require_once '../env/secret.php';
    try {
        $pdo = new PDO("mysql:host=$_ENV['DB_HOST'];dbname=$_ENV['DB_NAME'];charset=utf8mb4", $_ENV['DB_USER'], $$_ENV['DB_PASS']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
?>