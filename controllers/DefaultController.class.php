<?php

// Définition de l'espace de noms de la classe
namespace MyFramework;

// Définition de la classe DefaultController qui hérite de DefaultModel
class DefaultController extends DefaultModel {

    // Méthode pour gérer l'action par défaut
    public function defaultAction() {
        
        // Appel de la méthode render pour préparer la vue
        // En passant le prénom récupéré via la méthode getLogin() en tant que donnée
        $this->render(['prenom' => $this->getLogin()]);

    }

    // Méthode pour gérer l'action de connexion
    public function connexionAction() {

        // Récupération de l'URL actuelle
        $url = $_SERVER['REQUEST_URI'];

        // Récupération du login depuis le formulaire de connexion, s'il est défini
        $login = isset($_POST['login']) ? $_POST['login'] : null;

        // Appel de la méthode render de la classe Core pour préparer la vue
        // En passant l'URL et le login en tant que données
        Core::render([
            'url' => $url,
            'login' => $login
        ]);

    }

}
