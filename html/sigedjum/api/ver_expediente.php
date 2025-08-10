<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../php/db.php";

try {
    $conn = new DataBaseConnection();
    $pdo = $conn->getConnection();

    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo json_encode(['success' => false, 'error' => 'No se especificó ID']);
        exit;
    }

    $sql = "SELECT
        c.id, c.title, c.description, c.status, c.created_at,
        ct.name AS case_type_name,
        sp.name AS sponsored_partner_name,
        ap.name AS accuser_partner_name,
        u.username AS assigned_username,
        p.name AS partner_name
    FROM `case` c
    LEFT JOIN case_type ct ON c.case_type_id = ct.id
    LEFT JOIN partner sp ON c.sponsored_partner_id = sp.id
    LEFT JOIN partner ap ON c.accuser_partner_id = ap.id
    LEFT JOIN users u ON c.assigned_user_id = u.id
    LEFT JOIN partner p ON c.partner_id = p.id
    WHERE c.id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    $expediente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($expediente) {
        echo json_encode(['success' => true, 'expediente' => $expediente]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Expediente no encontrado']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
