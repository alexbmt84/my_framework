<?php

// Définition de l'espace de noms de la classe
namespace MyFramework;

// Définition de la classe DefaultModel qui hérite de Core
class DefaultModel extends Core {

    // Méthode pour obtenir des données de la table 'routing'
    public function getData() {

        // Exécution d'une requête SQL pour sélectionner tous les enregistrements de la table 'routing'
        $stmt = Core::$_pdo->query("SELECT * FROM routing");

        // Retour des résultats sous forme d'un tableau associatif
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    // Méthode pour obtenir un prénom (ici simplement d'une valeur codée en dur)
    public function getLogin() {

        // Retour du prénom "Alexis"
        return "Alexis";

    }

}
