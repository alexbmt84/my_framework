<?php

function getAllDirectories($baseDir): array {

    // Initialisation d'un tableau vide pour stocker les noms des répertoires
    $directories = [];

    // Parcours de tous les fichiers/dossiers du répertoire de base
    foreach (scandir($baseDir) as $file) {

        // Ignorer les entrées '.' et '..'
        if ($file === '.' || $file === '..') continue;

        // Vérifier si l'élément actuel est un répertoire
        if (is_dir($baseDir . DIRECTORY_SEPARATOR . $file)) {

            // Ajouter le nom du répertoire au tableau
            $directories[] = $file;

        }

    }

    // Retourner le tableau des noms des répertoires
    return $directories;

}

// Appeler la fonction getAllDirectories avec le chemin absolu du répertoire racine du serveur
// BASE_URI est une constante préalablement définie qui contient la base URI du projet
$directories = getAllDirectories($_SERVER['DOCUMENT_ROOT'] . BASE_URI);

// Fonction pour charger automatiquement les classes en utilisant une recherche récursive
function recursive_autoload($pattern = ROOT. DIRECTORY_SEPARATOR .'*') : void {

    // Parcours des éléments correspondant au motif donné
    foreach (glob($pattern, GLOB_MARK) as $item) {

        // Vérifier si l'élément est un répertoire
        if (str_ends_with($item, DIRECTORY_SEPARATOR)) {

            // Si c'est un répertoire, rappeler la fonction avec un nouveau motif
            recursive_autoload("$item*");

        } else if(str_ends_with($item, '.class.php')) { // Vérifier si l'élément est un fichier de classe

            // Inclure le fichier de classe
            require_once $item;

        }

    }

}

// Enregistrement de la fonction de chargement automatique
spl_autoload_register(function () use ($directories) {

    // Appeler la fonction de chargement automatique récursif
    recursive_autoload();

});
