<?php

    namespace MyFramework;

    use Exception;
    use PDO;

    class User extends Core {

        public int $id;
        public string $username;
        public string $email;
        public string $password;
        public function __construct() {

            $this->id = 0;
            $this->username = "";
            $this->email = "";
            $this->password = "";

        }

        // Avant
        public function creerCompte() {

            $username = $this-> username;
            $email = $this->email;
            $password = $this-> password;

            $query = self::$_pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password);");

            try {

                $query->bindParam(":username", $username, PDO::PARAM_STR);
                $query->bindParam(":email", $email, PDO::PARAM_STR);
                $query->bindParam(":password", $password, PDO::PARAM_STR);

                return $query->execute();

            } catch (Exception $exc) {

                return false;

            }

        }

        // Après
        public function create() {

            $db = new Database('localhost', 'root', '', 'my_framework');
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

            $params = [$this->username, $this->email, $this->password];
            $stmt = $db->query($sql, $params);

            return $stmt->rowCount();

        }

        public static function find($id) {

            $db = new Database('localhost', 'root', '', 'my_framework');
            $sql = "SELECT * FROM users WHERE id = ?";
            $params = [$id];

            $stmt = $db->query($sql, $params);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null;
            }

            return $result;

        }

    }