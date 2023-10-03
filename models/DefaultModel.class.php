<?php

namespace MyFramework;

use PDOException;

class DefaultModel extends Core {

    public function checkLogin($username, $password) {

        try {

            $stmt = self::$_pdo->prepare("SELECT password FROM users WHERE username = ?");
            $stmt->execute([$username]);

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
