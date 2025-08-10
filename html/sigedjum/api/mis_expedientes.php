<?php
header('Content-Type: application/json; charset=utf-8');

// En producción, acá iría la conexión a la base de datos y query filtrando por $_GET['search']
// Ejemplo: SELECT * FROM expedientes WHERE name LIKE :search ORDER BY date DESC

$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

$data = [
    ["id" => 1, "name" => "Caso López", "description" => "Robo agravado", "status" => "En proceso", "date" => "2025-05-10"],
    ["id" => 2, "name" => "Caso Pérez", "description" => "Estafa bancaria", "status" => "Archivado", "date" => "2025-03-14"],
    ["id" => 3, "name" => "Caso García", "description" => "Lesiones graves", "status" => "En proceso", "date" => "2025-06-20"],
];

if ($search !== '') {
    $data = array_filter($data, function($item) use ($search) {
        return strpos(strtolower($item['name']), $search) !== false ||
               strpos(strtolower($item['description']), $search) !== false;
    });
}

echo json_encode([
    "success" => true,
    "expedientes" => array_values($data)
], JSON_UNESCAPED_UNICODE);
