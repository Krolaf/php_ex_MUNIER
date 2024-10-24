<?php
// Définir aléatoirement le mode (clair ou sombre)
$mode = rand(0, 1) ? 'dark-mode' : 'light-mode'; // 0 pour mode clair, 1 pour mode sombre
$header = '    <link rel="stylesheet" href="style.css">';
// Définir un message de salutation
$greeting = "Bonne journée !";

$tableau_users =array("jey","dodo","jerem","lou");

$users = '';
foreach($tableau_users as $user) {
    $users .= ' </br> '. $user .' </br> ';
}

$page = '
        
    <head>
        <title>Page d\'accueil</title>

        <!-- CSS pour le style -->
        '.$header.'
    </head>
    <body class="'.$mode.'" >

        <!-- Contenu principal -->
        <h1>'.$greeting.'</h1>
        '.$users.'
    </body>';


    echo $page;
?>


