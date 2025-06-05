<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once "db.php";
    $input = file_get_contents("php://input");
    $data = json_decode($input);

    // $email = $data->email ?? '';
    // $password = $data->password ?? '';

    $numeroFactura = $data->numeroFactura ?? '';
    $fecha = $data->fecha ?? '';
    $condicionVenta = $data->condicionVenta ?? '';
    $cliente = $data->cliente ?? '';
    $lineas = $data->lineas ?? [];
    

    try {
        $conn = new DataBaseConnection();

        $client_id = $conn->read(query: "SELECT id FROM persona WHERE nip = :cliente", params: [":cliente" => $cliente]);

        
        $writeQuery = "INSERT INTO factura (empresa_id,cliente_id,fecha,numero,condicion) VALUES (:empresa_id, :cliente_id, :fecha, :numero, :condicion)";


        $factura_id = $conn->write($writeQuery, [
            ":empresa_id" => 1, // Assuming a fixed company ID for simplicity
            ":cliente_id" => $client_id[0]['id'] ?? null,
            ":fecha" => $fecha,
            ":numero" => $numeroFactura,
            ":condicion" => $condicionVenta
        ]);

        if (!$factura_id) {
            throw new Exception("Error al crear la factura");
        }


        foreach ($lineas as $linea) {
            $writeLineQuery = "INSERT INTO factura_linea (factura_id, descripcion, cantidad, precio_unitario) VALUES (:factura_id, :descripcion, :cantidad, :precio_unitario)";
            $conn->write($writeLineQuery, [
                ":factura_id" => $factura_id,
                ":descripcion" => $linea->descripcion,
                ":cantidad" => $linea->cantidad,
                ":precio_unitario" => $linea->precioUnitario
            ]);
        }

        echo $res
            ? json_encode(["success" => true, "message" => "Login correcto"])
            : json_encode(["success" => false, "message" => "Credenciales inválidas"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Error interno", "error" => $e->getMessage()]);
    }
    
?>