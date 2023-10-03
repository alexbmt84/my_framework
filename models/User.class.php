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

    }