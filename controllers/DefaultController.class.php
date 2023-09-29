<?php

    namespace MyFramework;

    class DefaultController extends DefaultModel {

        public function defaultAction() {

            $this->render(['prenom' => $this->getLogin()]);

        }

        public function ConnexionAction() {

            $params = [];

            if (isset($_POST['login']) && !empty($_POST['login'])) {
                $params['login'] = $_POST['login'];
            }

            $params['url'] = $_SERVER['REQUEST_URI'];

            Core::render($params);

        }

    }