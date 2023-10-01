<?php

// Définition de l'espace de noms de la classe
namespace MyFramework;

// Définition de la classe DefaultModel qui hérite de Core
class DefaultModel extends Core {

    // Méthode pour obtenir un prénom (ici simplement d'une valeur codée en dur)
    public function getLogin() {

        // Retour du prénom "Alexis"
        return "Alexis";

    }

}
