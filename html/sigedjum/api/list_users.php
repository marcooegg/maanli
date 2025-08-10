<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../php/db.php";

try {
    $conn = new DataBaseConnection();
    $pdo = $conn->getConnection();

    $stmt = $pdo->query("SELECT users.id, partner.name FROM users INNER JOIN partner on users.partner_id = partner.id ORDER BY name");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'users' => $data]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}