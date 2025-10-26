<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "db.php";

try {
    // Leer body (axios suele enviar JSON) y fallback a $_POST
    $raw = file_get_contents('php://input');
    $data = null;

    if ($raw !== false && $raw !== '') {
        $decoded = json_decode($raw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $data = $decoded;
        }
    }

    if (empty($data) && !empty($_POST)) {
        $data = $_POST;
    }

    if (!is_array($data)) {
        $data = [];
    }

    // Normalizar campos esperados
    $dni = isset($data['dni']) ? trim($data['dni']) : null;
    $nombre = isset($data['nombre']) ? trim($data['nombre']) : null;
    $telefono = isset($data['telefono']) ? trim($data['telefono']) : null;

    $data = [
        'dni' => $dni,
        'nombre' => $nombre,
        'telefono' => $telefono
    ];
    $conn = new DataBaseConnection();
    $pdo = $conn->getConnection();

    $pdo->write('clientes',$data);
    echo json_encode(['success' => true, 'clientes' => $data]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

echo json_encode(['ok'=>true])

?>