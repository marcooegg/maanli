<?php
    require_once "db.php";
    $input = file_get_contents("php://input");
    $data = json_decode($input);

    $email = $data->email ?? '';
    $password = $data->password ?? '';

    // aca falta conectase a la db que todavia no se si tengo
    // if ($email === 'admin@example.com' && $password === '1234') {
    //     echo json_encode(["success" => true, "message" => "Login correcto"]);
    // } else {
    //     echo json_encode(["success" => false, "message" => "Credenciales inválidas"]);
    // }

    $query = $pdo->prepare("SELECT * FROM user WHERE login = :email");
    $query->execute(['email' => $email]);
    $res = $query->fetch(PDO::FETCH_ASOC);
    echo $res ? json_encode(["success" => true, "message" => "Login correcto"]) : json_encode(["success" => false, "message" => "Credenciales inválidas"]);
    // echo json_encode(["email" => $email, "password" => $password]);
    
?>