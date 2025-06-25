<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    class DataBaseConnection {
        public $pdo;

        public function __construct($host = "localhost", $port = "2092", $user = "c2821127_trprac", $pass = "ti38LUpali", $name = "c2821127_trprac", $charset = "utf8mb4") {
            try {
                $this->pdo = new PDO("mysql:host=$host;port=$port;dbname=$name;charset=$charset", $user, $pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new Exception("Error de conexión: " . $e->getMessage());
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
            // $this->closeConnection();
            return $stmt->fetchAll($fetchMode);
        }

        public function write($query, $params = []) {
            $stmt = $this->pdo->prepare($query);
            $res = $stmt->execute($params);
            // $this->closeConnection();
            // return $this->pdo->prepare("SELECT LAST_INSERT_ID()")->execute([]);
            return $this->pdo->lastInsertId();
        }
    }
?>