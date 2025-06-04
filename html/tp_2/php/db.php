<?php
    // require_once '../env/secret.php';
    // $DB_HOST = 'c282.ferozo.com';
    // $DB_HOST = "localhost";
    // $DB_PORT = '2092';
    // $DB_USER = 'c2821127_JURI_01';
    // $DB_PASS = 'PUnuru87fi';
    // $DB_NAME = 'c2821127_JURI_01';
    // $DB_CHARSET = 'utf8mb4';
    class DataBaseConnection {
        public $pdo;

        public function __construct($host = "localhost", $port = "2092", $user = "c2821127_trprac", $pass = "PUnuru87fi", $name = "c2821127_trprac", $charset = "utf8mb4") {
            try {
                $this->pdo = new PDO("mysql:host=$host;port=$port;dbname=$name;charset=$charset", $user, $pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        public function getConnection() {
            return $this->pdo;
        }

        public function closeConnection() {
            $this->pdo = null;
        }

        public function read($query, $params = [], $fetchMode = PDO::FETCH_ASSOC) {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll($fetchMode);
        }
    }
    // try {
    //     $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS);
    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // } catch (PDOException $e) {
    //     die("Error de conexión: " . $e->getMessage());
    // }
?>