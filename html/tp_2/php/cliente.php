<?php
require_once "db.php";
$input = file_get_contents("php://input");
$data = json_decode($input);
echo $data;
if (isset($data->cuit)) {
    $cuit = $data->cuit;
    $query = "SELECT * FROM persona WHERE nip = ?";
    $params = [$cuit];
    $cliente = $conn->read($query, $params);
    if ($cliente) {
        echo json_encode(["success" => true, "cliente" => $cliente[0]]);
    } else {
        echo json_encode(["success" => false]);
    }
} else {
    echo json_encode(["success" => false]);
}
?>