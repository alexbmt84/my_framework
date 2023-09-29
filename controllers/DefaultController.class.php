<?php

namespace MyFramework;

class DefaultController extends DefaultModel {


    protected $model;

    public function defaultAction()
    {
        $model = new DefaultModel();
        $data = $model->getData();

        $this->render(['prenom' => $this->getLogin()]);
        // Envoyer les données à la vue pour les afficher

    }

    public function connexionAction()
    {
        $url = $_SERVER['REQUEST_URI'];
        $login = isset($_POST['login']) ? $_POST['login'] : null;

        Core::render([
            'url' => $url,
            'login' => $login
        ]);

    }

    public function someAction() {

        $results = DefaultModel::someQuery();

        //Traitement des résultats et affichage ...

    }

}

