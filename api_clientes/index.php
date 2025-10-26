<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "db.php";

try {
    $conn = new DataBaseConnection();
    $pdo = $conn->getConnection();

    $stmt = $pdo->query("SELECT id_cliente, nombre, dni, telefono FROM `clientes` ORDER BY id_cliente");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

// echo json_encode([
//   ['dni'=>"234", "nya"=>"María Gómez", "tel"=>"5555-6666",],
//   ['dni'=>"567", "nya"=>"Luis Martínez", "tel"=>"7777-8888",]
// ])

?>