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
        $query = $pdo->prepare("SELECT * FROM user WHERE login = :email");
        $query->execute(['email' => $email]);
        $res = $query->fetch(PDO::FETCH_ASSOC);

        echo $res
            ? json_encode(["success" => true, "message" => "Login correcto"])
            : json_encode(["success" => false, "message" => "Credenciales inválidas"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Error interno", "error" => $e->getMessage()]);
    }
    
?>