<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once "db.php";

    $descripcion = $_GET['descripcion'] ?? '';

    try {
        $conn = new DataBaseConnection();
        $query = "SELECT * FROM producto WHERE descripcion LIKE :descripcion";
        $res = $conn->read($query, [":descripcion" => "%" . $descripcion ."%"]);

        echo $res
            ? json_encode(["success" => true, "message" => $res])
            : json_encode(["success" => false, "message" => "Credenciales inválidas"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Error interno", "error" => $e->getMessage()]);
    }
    
?>