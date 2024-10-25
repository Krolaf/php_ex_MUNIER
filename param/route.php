<?php

        $page = array();
        $page['home'] = 'home.php'; //connect

        if(user_is_connected()){
            $page['home'] = 'home.php';
        }

        // Gestion des routes !
        if (isset($_GET['page']) && isset($page[$_GET['page']])) {
            // La page demandé existe => on va pouvoir l'afficher !
            $url_php = $page[$_GET['page']];
        } else {
            // Forcer l'affichage de la page d'accueil du Front Office
            if(user_is_connected()){
                $url_php = $page['home'];
            } else {
                $url_php = $page['home']; //connect
            }
        }
?>