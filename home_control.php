<?php 
$db = new data();

// Ajouter une feuille de style
$header = ' <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">';


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
<main>
<div class="admin-container">

            <div class="card">
                <h2>Titre</h2>
                <p><span class="stat">ID:</span> <span class="stat-value"></span></p>
                <p><span class="stat">HP:</span> <span class="stat-value"></span></p>
                <p><span class="stat">Force:</span> <span class="stat-value"></span></p>
                <p><span class="stat">Intelligence:</span> <span class="stat-value"></span></p>
                <p><span class="stat">Endurance:</span> <span class="stat-value"></span></p>
                <p><span class="stat">Dexterité:</span> <span class="stat-value"></span></p>
                <div class="btn_zone">
                    <button><i class="fas fa-user"></i></button>
                    <button><i class="fas fa-cog"></i></button>
                </div>
            </div>
</div>

<div class="navbar">

banane

</div>

<div class="listing-container">';



    if (!empty($datas_items)) {
        foreach ($datas_items as $data_item) {
            $page .= '
            <div class="card">
                <h2>' . $data_item['name'] . '</h2>
                <p><span class="stat">ID:</span> <span class="stat-value">' . $data_item['id'] . '</span></p>
                <p><span class="stat">HP:</span> <span class="stat-value">' . $data_item['hp'] . '</span></p>
                <p><span class="stat">Force:</span> <span class="stat-value">' . $data_item['force'] . '</span></p>
                <p><span class="stat">Intelligence:</span> <span class="stat-value">' . $data_item['intelligence'] . '</span></p>
                <p><span class="stat">Endurance:</span> <span class="stat-value">' . $data_item['endurance'] . '</span></p>
                <p><span class="stat">Dexterité:</span> <span class="stat-value">' . $data_item['dexterité'] . '</span></p>
            </div>
            ';
        }
    }

$page .= '</div>

</main>
</body>
';
echo $page;

?>