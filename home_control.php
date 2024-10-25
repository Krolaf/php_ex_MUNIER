<?php 
$db = new Data(); // Utilisation de l'instance correcte de ta classe Data

// Ajouter une feuille de style
$header = ' <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">';

// Requête SQL pour récupérer tous les éléments
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

// Vérification si `delete_id` est présent pour suppression
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    $id_item = $_GET['delete_id'];
    $db->sql_delete('t_champion', $id_item);

    header("Location: index.php");
    exit();
}

// Vérification si `edit_id` est présent pour édition
$selected_item = null;
if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) {
    $id_item = $_GET['edit_id'];
    $selected_item = $db->build_r_from_id('t_champion', $id_item); // Récupère les infos du personnage sélectionné
}

$page = '
<head>
    <title>Page d\'accueil</title>
    <!-- CSS pour le style -->
    ' . $header . '
</head>
<body class="' . $mode . '">
<main>
<div class="admin-container">
    <!-- Section pour afficher les informations du personnage sélectionné -->
    <div class="card">
        <h2>' . ($selected_item ? $selected_item['name'] : 'Titre') . '</h2>
        <p><span class="stat">HP:</span> <span class="stat-value">' . ($selected_item ? $selected_item['hp'] : '') . '</span></p>
        <p><span class="stat">Force:</span> <span class="stat-value">' . ($selected_item ? $selected_item['force'] : '') . '</span></p>
        <p><span class="stat">Intelligence:</span> <span class="stat-value">' . ($selected_item ? $selected_item['intelligence'] : '') . '</span></p>
        <p><span class="stat">Endurance:</span> <span class="stat-value">' . ($selected_item ? $selected_item['endurance'] : '') . '</span></p>
        <p><span class="stat">Dexterité:</span> <span class="stat-value">' . ($selected_item ? $selected_item['dexterité'] : '') . '</span></p>
        <a class="edit-btn">
                  Modifier <i class="fa-solid fa-pen"></i>
                </a>
    </div>
</div>

<div class="navbar">
    banane
</div>

<div class="listing-container">';

// Boucle sur les éléments récupérés
if (!empty($datas_items)) {
    foreach ($datas_items as $data_item) {
        $page .= '
        <div class="card">
            <h2>' . $data_item['name'] . '</h2>
            <p><span class="stat">HP:</span> <span class="stat-value">' . $data_item['hp'] . '</span></p>
            <p><span class="stat">Force:</span> <span class="stat-value">' . $data_item['force'] . '</span></p>
            <p><span class="stat">Intelligence:</span> <span class="stat-value">' . $data_item['intelligence'] . '</span></p>
            <p><span class="stat">Endurance:</span> <span class="stat-value">' . $data_item['endurance'] . '</span></p>
            <p><span class="stat">Dexterité:</span> <span class="stat-value">' . $data_item['dexterité'] . '</span></p>
            <div class="btn_zone">
                <a href="index.php?edit_id=' . $data_item['id'] . '" class="edit-btn">
                   <i class="fa-solid fa-pen"></i>
                </a>
                <a onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet élément ?\')" 
                   href="index.php?delete_id=' . $data_item['id'] . '" 
                   class="delete-btn">
                   <i class="fa-solid fa-trash"></i>
                </a>
            </div>
        </div>
        ';
    }
}

$page .= '</div>

</main>
</body>';

echo $page;

?>
