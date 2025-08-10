<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../php/db.php";

try {
    $conn = new DataBaseConnection();
    $pdo = $conn->getConnection();

    // Recibir datos POST (esperamos JSON o x-www-form-urlencoded)
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        $input = $_POST;
    }

    $id = $input['id'] ?? null;
    if (!$id) {
        echo json_encode(['success' => false, 'error' => 'ID es obligatorio para editar']);
        exit;
    }

    $title = $input['title'] ?? '';
    $description = $input['description'] ?? '';
    $status = $input['status'] ?? '';
    $case_type_id = $input['case_type_id'] ?? null;
    $sponsored_partner_id = $input['sponsored_partner_id'] ?? null;
    $accuser_partner_id = $input['accuser_partner_id'] ?? null;
    $assigned_user_id = $input['assigned_user_id'] ?? null;
    $partner_id = $input['partner_id'] ?? null;

    $sql = "UPDATE `case` SET
        title = :title,
        description = :description,
        status = :status,
        case_type_id = :case_type_id,
        sponsored_partner_id = :sponsored_partner_id,
        accuser_partner_id = :accuser_partner_id,
        assigned_user_id = :assigned_user_id,
        partner_id = :partner_id,
        updated_at = CURRENT_TIMESTAMP
        WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':status' => $status,
        ':case_type_id' => $case_type_id,
        ':sponsored_partner_id' => $sponsored_partner_id,
        ':accuser_partner_id' => $accuser_partner_id,
        ':assigned_user_id' => $assigned_user_id,
        ':partner_id' => $partner_id,
        ':id' => $id
    ]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}