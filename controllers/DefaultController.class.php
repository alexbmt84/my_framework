<?php

namespace MyFramework;

class DefaultController extends DefaultModel {

    // Méthode pour gérer l'action par défaut
    public function defaultAction() {
        
        // Appel de la méthode render pour préparer la vue
        // En passant le prénom récupéré via la méthode getLogin() en tant que donnée
        $this->render(['prenom' => $this->getLogin()]);

    }

    // Méthode pour gérer l'action de connexion
    public function connexionAction() {

        $url = $_SERVER['REQUEST_URI'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $login = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;

            if ($login && $password && $this->checkLogin($login, $password)) {

                $_SESSION['auth'] = true; // L'utilisateur est authentifié
                $_SESSION['login'] = $login;

                header('Location: ' . BASE_URI . '/home');

                exit();

            } else {

                $errorMessage = "Identifiants incorrects!";

                Core::render([
                    'url' => $url,
                    'error' => $errorMessage
                ]);

            }

        } else {

            Core::render(['url' => $url]);

        }

    }

    public function homeAction() {
        $username = $_SESSION['login'];
        $this->render(['username' => $username]);
    }

    public function logoutAction() {

        session_destroy();

        header('Location: ' . BASE_URI . '/connexion');
        exit();
    }

    public function registerAction() {

        $this->render();

    }



}
