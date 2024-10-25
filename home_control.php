<?php 
$db = new Data(); // Utilisation de l'instance correcte de ta classe Data

// Ajouter une feuille de style
$header = ' <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <script src="script.js"></script>
            ';

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

// Traitement du formulaire de création ou de mise à jour
$error_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation côté serveur pour le champ name
    if (empty($_POST['name'])) {
        $error_message = "Le nom du personnage ne peut pas être vide.";
    } elseif (strlen($_POST['name']) > 15) {
        $error_message = "Le nom ne peut pas dépasser 15 caractères.";
    } else {
        // Récupération des valeurs du formulaire
        $new_data = [
            'name' => $_POST['name'],
            'hp' => $_POST['hp'],
            'force' => $_POST['force'],
            'intelligence' => $_POST['intelligence'],
            'endurance' => $_POST['endurance'],
            'dexterité' => $_POST['dexterité']
        ];

        if (!empty($_POST['update_id'])) {
            // Mise à jour si un ID est fourni
            $db->sql_update('t_champion', $_POST['update_id'], $new_data);
        } else {
            // Création d'un nouveau personnage si aucun ID n'est fourni
            $db->sql_insert('t_champion', $new_data);
        }

        header("Location: index.php"); // Redirection après modification ou création
        exit();
    }
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
   
    <!-- Section pour afficher modifier et creer les informations d\'un nouveau personnage -->
    <div class="card">
        <form method="POST" action="index.php">
            <input type="hidden" name="update_id" value="' . ($selected_item ? $selected_item['id'] : '') . '">
            <h2><span class="stat">Nom:</span>
                <input type="text" name="name" value="' . ($selected_item ? $selected_item['name'] : '') . '">
            </h2>
            <p><span class="stat">HP:</span>
                <button type="button" onclick="modifyStat(\'hp\', -1)">-</button>
                <input type="number" id="hp" name="hp" value="' . ($selected_item ? $selected_item['hp'] : 0) . '" readonly>
                <button type="button" onclick="modifyStat(\'hp\', 1)">+</button>
            </p>
            <p><span class="stat">Force:</span>
                <button type="button" onclick="modifyStat(\'force\', -1)">-</button>
                <input type="number" id="force" name="force" value="' . ($selected_item ? $selected_item['force'] : 0) . '" readonly>
                <button type="button" onclick="modifyStat(\'force\', 1)">+</button>
            </p>
            <p><span class="stat">Intelligence:</span>
                <button type="button" onclick="modifyStat(\'intelligence\', -1)">-</button>
                <input type="number" id="intelligence" name="intelligence" value="' . ($selected_item ? $selected_item['intelligence'] : 0) . '" readonly>
                <button type="button" onclick="modifyStat(\'intelligence\', 1)">+</button>
            </p>
            <p><span class="stat">Endurance:</span>
                <button type="button" onclick="modifyStat(\'endurance\', -1)">-</button>
                <input type="number" id="endurance" name="endurance" value="' . ($selected_item ? $selected_item['endurance'] : 0) . '" readonly>
                <button type="button" onclick="modifyStat(\'endurance\', 1)">+</button>
            </p>
            <p><span class="stat">Dexterité:</span>
                <button type="button" onclick="modifyStat(\'dexterité\', -1)">-</button>
                <input type="number" id="dexterité" name="dexterité" value="' . ($selected_item ? $selected_item['dexterité'] : 0) . '" readonly>
                <button type="button" onclick="modifyStat(\'dexterité\', 1)">+</button>
            </p>
            <button type="submit" class="edit-btn">' . ($selected_item ? 'Modifier <i class="fa-solid fa-pen"></i>' : ' creer <i class="fa-solid fa-plus"></i></i>') . '</button>
        </form>
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
