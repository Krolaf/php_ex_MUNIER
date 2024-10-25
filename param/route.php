<?php

        $page = array();
        $page['connect'] = 'connect.php'; //connect

        if(user_is_connected()){
            $page['home'] = 'home.php';
            $page['logout'] = 'logout.php';
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
                $url_php = $page['connect']; //connect
            }
        }

                // Gestion Controleur
        $url_php_control = str_replace('.php','_control.php',$url_php);
        if(is_file($url_php_control)) {
            require $url_php_control;
        }
?>