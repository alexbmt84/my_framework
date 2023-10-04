<?php

namespace MyFramework;

use PDO;
use PDOException;

class Core
{
    // Définition des propriétés statiques pour le routage, le rendu et la connexion à la base de données
    static protected $_routing = [];
    static private $_render;
    static protected $_pdo;

    // Constructeur de la classe
    public function __construct() {

        // Définition des paramètres de connexion à la base de données
        $user = "root";
        $password = "";
        $database = "my_framework";
        $dsn = "mysql:dbname=" . $database . ";host=localhost";

        // Connexion à la base de données via PDO
        self::$_pdo = new \PDO($dsn, $user, $password);

        // Activation des exceptions pour les erreurs PDO
        self::$_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    }

    // Fonction pour gérer le routage
    private function routing() {

        // Extraction de l'URI demandée
        $uri = str_replace(str_replace('\\', '/', BASE_URI), '', $_SERVER['REQUEST_URI']);

        // Division de l'URI en segments
        $parts = [...array_filter(explode('/', $uri))];

        // Requête SQL pour obtenir le vrai chemin basé sur l'URL
        $stmt = self::$_pdo->prepare("SELECT real_path FROM routing WHERE url = ?");
        $stmt->execute([$parts[0] ?? '']);

        // Récupération du vrai chemin de la base de données
        $real_path = $stmt->fetchColumn();

        if ($real_path) {

            // Si un vrai chemin est trouvé, on le divise en segments
            $real_parts = explode('/', $real_path);

            // Assignation du contrôleur et de l'action basés sur le vrai chemin
            $controller = ucfirst($real_parts[0]) ?? 'default';

            $action = $real_parts[1] ?? 'default';

        } else {

            // Si aucun vrai chemin n'est trouvé, utilisation des segments d'URI comme contrôleur et action
            $controller = ucfirst($parts[0] ?? 'default');

            $action = $parts[1] ?? 'default';

        }

        // Stockage du contrôleur et de l'action dans la propriété statique $_routing
        self::$_routing = [
            'controller' => $controller,
            'action' => $action
        ];

    }

    protected function render($params = [], $isPartial = false) {

        // Récupère l'url complète
        $viewPath = implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'views', self::$_routing['controller'], self::$_routing['action']]) . '.html';

        // Si le fichier que nous recherchons existe...
        if (file_exists($viewPath)) {

            // On récupère son contenu...
            $viewContent = file_get_contents($viewPath);

            foreach ($params as $k => $v) {

                $viewContent = preg_replace("/\{\{\s*$k\s*\}\}/", $v, $viewContent);

            }

            if ($isPartial) {

                self::$_render = $viewContent;

            } else {

                $layoutPath = dirname(__DIR__) . '/views/layout.html';

                if (file_exists($layoutPath)) {

                    $layoutContent = file_get_contents($layoutPath);
                    self::$_render = str_replace('{{ content }}', $viewContent, $layoutContent);

                }

            }

        } else {

            self::$_render = "Impossible de trouver la vue" . PHP_EOL;

        }

    }

    protected function renderPartial($params = []) {
        $this->render($params, true);
    }


    // Fonction principale pour exécuter l'application
    public function run() {

        // Appel de la fonction de routage
        $this->routing();

        // Création d'une instance du contrôleur basé sur le routage
        $c = __NAMESPACE__ . '\\' . ucfirst(self::$_routing['controller']) . 'Controller';


        $o = new $c();

        // Vérification de l'existence de la méthode d'action et son exécution
        if (method_exists($o, $a = self::$_routing['action'] . 'Action')) {

            $o->$a();

        } else {

            // Si la méthode n'existe pas, afficher un message d'erreur
            self::$_render = "Impossible de trouver la methode" . PHP_EOL;

        }

        // Affichage du rendu final
        echo self::$_render;

    }

}
