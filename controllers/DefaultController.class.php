<?php

    namespace MyFramework;

    class DefaultController extends DefaultModel {

        public function defaultAction() {

            $this->render(['prenom' => $this->getLogin()]);

        }

    }