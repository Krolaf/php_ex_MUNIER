<?php
    unset($_SESSION[SESSION_NAME]);
    header('location: index.php');
        // Détruire la session
        session_unset();  // Supprime toutes les variables de session
        session_destroy();  // Détruit la session
        session_write_close(); // Ferme la session pour s'assurer qu'elle ne peut plus être utilisée
    exit();
?>