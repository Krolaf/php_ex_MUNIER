<?php

    $mode = rand(0, 1) ? 'dark-mode' : 'light-mode'; 
    define('SESSION_NAME','user_session');

    function user_is_connected(){
        //verifier la connexion
        return isset($_SESSION[SESSION_NAME]);
    }
    session_name(SESSION_NAME);
    session_start();

    require_once 'class/data.class.php';
    require_once 'param/route.php';
    

    // Gestion de la soumission du formulaire de connexion
    if (isset($_POST['login']) && !empty($_POST['login'])) {
        // Récupérer les données de l'utilisateur depuis le formulaire
        $login = $_POST['login'];
        $password = $_POST['password'];

        // Définir le login et mot de passe en dur
        $valid_login = 'admin';
        $valid_password = 'admin';  

        // Vérifier si le login et le mot de passe sont corrects
        if ($login === $valid_login && $password === $valid_password) {
            // Connexion réussie
            $_SESSION[SESSION_NAME] = $login;  // Enregistrer l'utilisateur dans la session
            header('Location: index.php');
            exit;
        } else {
            // Message d'erreur si le login ou le mot de passe est incorrect
            $html = '<div class="login_info_error">Erreur: Login ou mot de passe incorrect.</div>';
        }
}

    // Gestion Controleur
    $url_php_control = str_replace('.php','_control.php',$url_php);
    if(is_file($url_php_control)) {
        require $url_php_control;
    }
    // Déconnecter l'utilisateur à chaque chargement de page
    if (isset($_SESSION[SESSION_NAME])) {
        // Détruire la session
        session_unset();  // Supprime toutes les variables de session
        session_destroy();  // Détruit la session
        session_write_close(); // Ferme la session pour s'assurer qu'elle ne peut plus être utilisée
    }
?>


