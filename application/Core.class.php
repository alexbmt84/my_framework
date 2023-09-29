<?php

namespace MyFramework;

class Core
{

//    static protected $_routing = [];
//    static private $_render;
//
//    private function routing() {
//
//        self::$_routing = [
//            'controller' => 'default',
//            'action' => 'default'
//        ];
//
//    }

    static protected $_routing = [];
    static private $_render;

    private function routing() {

        $uri = str_replace(BASE_URI, '', $_SERVER['REQUEST_URI']);

        $parts = array_filter(explode('/', $uri));

        var_dump("URL : " . $uri);

        $controller = 'Default';
        $action = 'default';

        var_dump("\$parts[1] : " . $parts[1],
            "Path : " . dirname(__DIR__) . '\controllers\\' . $controller . 'Controller.class.php');

        var_dump(isset($parts[1]) && file_exists(dirname(__DIR__) . '\controllers\\' . $controller . 'Controller.class.php'));

        if(isset($parts[1]) && file_exists(dirname(__DIR__) . '\controllers\\' . $controller . 'Controller.class.php')) {

            var_dump($parts);

            self::$_routing['controller'] = $parts[1];

            var_dump(self::$_routing['controller']);

        }

        if(!empty($parts[2])) {

            var_dump("\$parts[2] : " . $parts[2]);

           self::$_routing['action'] = $parts[2];

           var_dump(self::$_routing['action']);

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