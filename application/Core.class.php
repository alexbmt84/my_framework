<?php

namespace MyFramework;
use PDO;
use PDOException;

class Core
{

    static protected $_routing = [];
    static private $_render;
    static protected $_pdo;

    public function __construct() {

        $user = "root";
        $password = "";
        $database = "my_framework";
        $dsn = "mysql:dbname=" . $database . ";host=localhost";

        self::$_pdo = new \PDO($dsn, $user, $password);
        self::$_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    }

    private function routing() {

        $uri = str_replace(BASE_URI, '', $_SERVER['REQUEST_URI']);
        $parts = array_filter(explode('/', $uri));

        $stmt = self::$_pdo->prepare("SELECT real_path FROM routing WHERE url = ?");
        $stmt->execute([$parts[3] ?? '']);

        $real_path = $stmt->fetchColumn();

        if ($real_path) {
            $real_parts = explode('/', $real_path);

            $controller = ucfirst($real_parts[0]) ?? 'default';
            $action = $real_parts[1] ?? 'default';

        } else {

            $controller = ucfirst($parts[3] ?? 'Default');
            $action = $parts[2] ?? 'default';

        }

        self::$_routing = [
            'controller' => $controller,
            'action' => $action
        ];
    }

    protected function render($params = []) {

        $f = implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'views', self::$_routing['controller'], self::$_routing['action']]) . '.html';

        if (file_exists($f)) {

            $c = file_get_contents($f);

            foreach ($params as $k => $v) {
                $c = preg_replace("/\{\{\s*$k\s*\}\}/", $v, $c);
            }

            self::$_render = $c;

        } else {

        self::$_render = "Impossible de trouver la vue" . PHP_EOL;

        }

    }

    public function run() {

        $this->routing();

        $c = __NAMESPACE__ . '\\' . ucfirst(self::$_routing['controller']) . 'Controller';
        $o = new $c();

        if (method_exists($o, $a = self::$_routing['action'] . 'Action')) {

            $o->$a();

        } else {

            self::$_render = "Impossible de trouver la methode" . PHP_EOL;

        }

        echo self::$_render;

    }

}