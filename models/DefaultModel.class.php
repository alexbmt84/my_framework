<?php

    namespace MyFramework;

    class DefaultModel extends Core {

        protected static $_pdo;

        public function getData() {

            $stmt = Core::$_pdo->query("SELECT * FROM routing");
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        }

        public function getLogin() {

            return "Alexis";

        }

    }
