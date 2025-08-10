<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../php/db.php";

try {
    $conn = new DataBaseConnection();
    $pdo = $conn->getConnection();

    // Recibimos datos JSON POST (axios por default manda JSON)
    $input = json_decode(file_get_contents('php://input'), true);

    $sql = "INSERT INTO `case` 
      (title, description, status, case_type_id, sponsored_partner_id, accuser_partner_id, assigned_user_id, partner_id) 
      VALUES 
      (:title, :description, :status, :case_type_id, :sponsored_partner_id, :accuser_partner_id, :assigned_user_id, :partner_id)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':title' => $input['title'],
      ':description' => $input['description'],
      ':status' => $input['status'],
      ':case_type_id' => $input['case_type_id'],
      ':sponsored_partner_id' => $input['sponsored_partner_id'],
      ':accuser_partner_id' => $input['accuser_partner_id'],
      ':assigned_user_id' => $input['assigned_user_id'],
      ':partner_id' => $input['partner_id'],
    ]);

    echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}