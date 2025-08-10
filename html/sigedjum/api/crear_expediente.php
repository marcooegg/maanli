<?php
header('Content-Type: application/json; charset=utf-8');

// En un caso real, acá conectarías con la DB e insertarías los datos
// Recibir datos POST
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || empty($input['name']) || empty($input['description']) || empty($input['status']) || empty($input['date'])) {
    echo json_encode(["success" => false, "message" => "Datos incompletos"]);
    exit;
}

// Ejemplo de "guardado"
$newId = rand(100, 999); // Simulación de ID generado
echo json_encode([
    "success" => true,
    "id" => $newId,
    "message" => "Expediente creado correctamente"
], JSON_UNESCAPED_UNICODE);
