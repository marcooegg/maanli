<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../php/db.php";

try {
    // $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo = new DataBaseConnection();
    $search = $_GET['search'] ?? '';
    if ($search) {
        $stmt = $pdo->prepare("SELECT id, title, description, status, created_at FROM `case` WHERE title LIKE ? ORDER BY created_at DESC");
        $stmt->execute(["%$search%"]);
    } else {
        $stmt = $pdo->query("SELECT id, title, description, status, created_at FROM `case` ORDER BY created_at DESC");
    }

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'expedientes' => $data
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
