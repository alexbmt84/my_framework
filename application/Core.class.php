<?php

namespace MyFramework;

class Core
{

    static protected $_routing = [];
    static private $_render;

    private function routing() {

        self::$_routing = [
            'controller' => 'default',
            'action' => 'default'
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