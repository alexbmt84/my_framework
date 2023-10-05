<?php

    namespace MyFramework;

    use Exception;
    use PDO;

    class Database extends Core {

        private $host;
        private $user;
        private $pass;
        private $dbname;
        private $pdo;

        public function __construct($host, $user, $pass, $dbname) {

            $this->host = $host;
            $this->user = $user;
            $this->pass = $pass;
            $this->dbname = $dbname;
            $this->connect();

        }

        public function connect() {

            $dsn = "mysql:host=$this->host;dbname=$this->dbname";
            $this->pdo = new PDO($dsn, $this->user, $this->pass);

        }

        public function query($sql, $params = []) {

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;

        }

    }
