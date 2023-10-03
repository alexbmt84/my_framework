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

            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;

            if ($username && $password && $this->checkLogin($username, $password)) {

                $_SESSION['auth'] = true; // L'utilisateur est authentifié
                $_SESSION['username'] = $username;

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
        $username = $_SESSION['username'];
        $this->render(['username' => $username]);
    }

    public function logoutAction() {

        session_destroy();

        header('Location: ' . BASE_URI . '/connexion');
        exit();
    }

    public function registerAction() {

        $url = $_SERVER['REQUEST_URI'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

             if (isset($_POST["username"]) && $_POST["username"] != "") {

                 if (isset($_POST["email"]) && $_POST["email"] != "") {

                     if (isset($_POST["password"]) && $_POST["password"] != "" && strlen($_POST["password"]) > 1) {

                        $username = $_POST['username'] ?? null;
                        $email = $_POST['email'] ?? null;
                        $password = $_POST['password'] ?? null;

                        $newUser = new User();

                        $newUser->username = $username;
                        $newUser->email = $email;
                        $newUser->password = password_hash($password, PASSWORD_DEFAULT);

                        $newUser->creerCompte();

                         $_SESSION['auth'] = true;
                         $_SESSION['username'] = $username;

                         header('Location: ' . BASE_URI . '/home');

                         exit();

                     } else {
                        return "You must set a valid password.";
                     }

                 } else {
                     return "You must enter a valid email.";
                 }

             } else {
                return "You must choose a valid username.";
             }

        }

        Core::render([
            'url' => $url,
        ]);

    }

}
