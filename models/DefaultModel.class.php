<?php

namespace MyFramework;

class DefaultModel extends Core {

    public function checkLogin($login, $password) {

        try {

            $stmt = self::$_pdo->prepare("SELECT password FROM users WHERE username = ?");
            $stmt->execute([$login]);

            $hashedPassword = $stmt->fetchColumn();

            if ($hashedPassword && password_verify($password, $hashedPassword)) {

                return true;
            }

            return false;

        } catch (PDOException $e) {

            die('Erreur d\'authentification: ' . $e->getMessage());

        }

    }

    public function getLogin() {

        // Retour du prénom "Alexis" en dur...
        return "Alexis";

    }

}
