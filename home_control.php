<?php 
$db = new data();

// Définir aléatoirement le mode (clair ou sombre)
$mode = rand(0, 1) ? 'dark-mode' : 'light-mode'; // 0 pour mode clair, 1 pour mode sombre

// Ajouter une feuille de style
$header = '<link rel="stylesheet" href="style.css">';

// Définir un message de salutation
$greeting = "Bonne journée HUMAIN !";

$sql = 'SELECT 
            c.id, 
            c.name, 
            c.hp, 
            c.force, 
            c.intelligence, 
            c.endurance, 
            c.dexterité
        FROM t_champion AS c';


$datas_items = $db->get_data($sql);


$page = '
<head>
    <title>Page d\'accueil</title>
    <!-- CSS pour le style -->
    ' . $header . '
</head>
<body class="' . $mode . '">
    <!-- Contenu principal -->
    <h1>' . $greeting . '</h1>

    ';

    if (!empty($datas_items)) {
        foreach ($datas_items as $data_item) {
            $page .= '
                <p>
                    <strong>ID:</strong> ' . $data_item['id'] . '<br>
                    <strong>Name:</strong> ' . $data_item['name'] . '<br>
                    <strong>HP:</strong> ' . $data_item['hp'] . '<br>
                    <strong>Force:</strong> ' . $data_item['force'] . '<br>
                    <strong>Intelligence:</strong> ' . $data_item['intelligence'] . '<br>
                    <strong>Endurance:</strong> ' . $data_item['endurance'] . '<br>
                    <strong>Dexterité:</strong> ' . $data_item['dexterité'] . '<br>
                </p>
            ';
        }
    }


echo $page;

?>