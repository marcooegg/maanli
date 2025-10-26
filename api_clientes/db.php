<?php
    class DataBaseConnection {
        public $pdo;

        public function __construct($host = null, $port = null, $user = null, $pass = null, $name = null, $charset = "utf8mb4") {
            $host = 'localhost';
            $port = 2092;
            $user = 'c2821127_tprac3';
            $pass = 'ma83MUriwa';
            $name = 'c2821127_tprac3';
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

        public function read($fields = ["*"], $table = "", $where="", $fetchMode = PDO::FETCH_ASSOC) {
            $fields = implode(',', $fields);
            $query = "SELECT {$fields} FROM {$table}";
            if ($where) {
                $query .= "WHERE " . $where;
            }
            
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll($fetchMode);
        }

        // public function write(string $table,array $fields_values, $fetchMode = PDO::FETCH_ASSOC) {
        //     $fields = array_keys($fields_values);
        //     $values = array_values($fields_values);
        //     $query = "INSERT INTO {$table} ({$fields}) VALUES {$values}";

        //     $stmt = $this->pdo->prepare($query);
        //     $res = $stmt->execute($params);
        //     return $this->pdo->lastInsertId();
        // }

        // public function call(string $method,array $fields_values){
        //     $fields = array_keys($fields_values);
        //     $values = array_values($fields_values);
        //     $query = "CALL {$method}($fields)";
        //     $stmt = $this->pdo->prepare($query);
        //     $res = $stmt->execute($params);
        //     return $this->pdo->lastInsertId();
        // }
    }
?>