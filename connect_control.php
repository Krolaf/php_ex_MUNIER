<?php 
// Définir aléatoirement le mode (clair ou sombre)


// Ajouter une feuille de style
$header = '<link rel="stylesheet" href="style.css">';

// Définir un message de salutation
$greeting = "Bonjour humain !";

// Liste d'utilisateurs
$tableau_users = array("jey", "dodo", "jerem", "lou");

// Construction de la liste d'utilisateurs à afficher
$users = '';
foreach ($tableau_users as $user) {
    $users .= ' ' . $user . ' ';
}

// Construction de la page
$page = '
<head>
    <title>Page d\'accueil</title>
    <!-- CSS pour le style -->
    ' . $header . '
</head>
<body class="' . $mode . '">
    <div class="connection">
    <h2 class="connexion">Connexion</h2>
    <form class="form_connexion" id="connectForm" action="index.php?page=connect" method="POST">
        Pseudo :<br>
        <input type="text" name="login" id="login" required/><br>
        Mot de passe :<br>
        <input type="password" name="password" id="password" required/><br/><br>
        <input class="connexion_btn" type="submit" value="Se connecter">
    </form>
    </div>
</body>';

// Afficher la page
echo $page;

?>
