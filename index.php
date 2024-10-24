<?php
// Définir aléatoirement le mode (clair ou sombre)
$mode = rand(0, 1) ? 'dark-mode' : 'light-mode'; // 0 pour mode clair, 1 pour mode sombre

// Définir un message de salutation
$greeting = "Bonne journée !";

$page = `
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page d'accueil</title>

        <!-- CSS pour le style -->
        <style>
            /* Style général */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                transition: background-color 0.3s ease;
            }

            h1 {
                font-size: 2.5rem;
            }

            /* Mode clair */
            .light-mode {
                background-color: #f0f0f0;
                color: #333;
            }

            /* Mode sombre */
            .dark-mode {
                background-color: #333;
                color: #f0f0f0;
            }

            /* Media Queries pour rendre la page responsive */
            @media (max-width: 600px) {
                h1 {
                    font-size: 2rem;
                }
            }

            @media (max-width: 400px) {
                h1 {
                    font-size: 1.5rem;
                }
            }
        </style>
    </head>
    <body class="`.$mode.` ">

        <!-- Contenu principal -->
        <h1><?php echo `.$greeting`. ?></h1>

    </body>`


    
?>


