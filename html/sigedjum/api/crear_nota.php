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

    $sql = "INSERT INTO `notes` 
      (title, content, case_id, user_id, appointment_id) 
      VALUES 
      (:title, :content, :case_id, :user_id, :appointment_id)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $input['title'],
        ':content' => $input['content'],
        ':case_id' => $input['case_id'],
        ':user_id' => $input['user_id'],
        ':appointment_id' => $input['appointment_id'],
    ]);

    echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}