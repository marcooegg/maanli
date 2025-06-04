<?php
// require_once "db.php";
// $input = file_get_contents("php://input");
// $data = json_decode($input);
// echo json_encode($data);
// if (isset($data->cuit)) {
//     $conn = new DataBaseConnection();
//     $cuit = $data->cuit;
//     $query = "SELECT * FROM persona WHERE nip = :cuit";
//     $params = [":cuit" => $cuit];
//     $cliente = $conn->read($query, $params);
//     if ($cliente) {
//         echo json_encode(["success" => true, "cliente" => $cliente[0]]);
//     } else {
//         echo json_encode(["success" => false]);
//     }
// } else {
//     echo json_encode(["success" => false, "message" => "CUIT no proporcionado"]);
// }
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once "db.php";
    $input = file_get_contents("php://input");
    $data = json_decode($input);

    $cuit = $data->cuit ?? '';

    try {
        $conn = new DataBaseConnection();
        $query = "SELECT * FROM persona WHERE nip = :cuit";
        $res = $conn->read($query, [":cuit" => $cuit]);

        echo $res
            ? json_encode(["success" => true, "result" => $res[0]])
            : json_encode(["success" => false, "message" => "Cliente no encontrado"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Error interno", "error" => $e->getMessage()]);
    }
?>