<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../php/db.php";

try {
    $conn = new DataBaseConnection();
    $expediente_id = $_GET['expediente_id'] ?? null;
    if (!$expediente_id) {
        echo json_encode(['success' => false, 'error' => 'No se especificó ID']);
        exit;
    }
    $pdo = $conn->getConnection();
    $sql = "SELECT n.title,
        n.content
        -- n.created_at,
        -- n.updated_at,
        -- app.date as appointment_date,
        -- app.time as appointment_time,
        -- c.id as case_id,
        -- c.name as case_name,
        -- u.username
    FROM `notes` n
    LEFT JOIN appointment app ON n.appointment_id = app.id
    LEFT JOIN `case` c ON c.id = n.case_id
    LEFT JOIN (SELECT users.id, partner.name as username FROM users INNER JOIN partner on users.partner_id = partner.id ORDER BY name) u ON c.assigned_user_id = u.id
    WHERE c.id = :expediente_id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':expediente_id' => $expediente_id]);

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'notes' => $data]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}