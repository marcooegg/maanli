<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once "db.php";
    $input = file_get_contents("php://input");
    $data = json_decode($input);

    $email = $data->email ?? '';
    $password = $data->password ?? '';

    try {
        $conn = new DataBaseConnection();
        $res = $conn->read($fields = ["id"], $table="user", $where= "login = {$email} AND password = {$password}");
        echo $res
            ? json_encode(["success" => true, "message" => "Login correcto"])
            : json_encode(["success" => false, "message" => "Credenciales inválidas"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Error interno", "error" => $e->getMessage()]);
    }
    
?>