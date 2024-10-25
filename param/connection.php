<?php
    

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

?>