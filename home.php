<?php
session_start();
if (isset($_SESSION['username'])) {
    
?>


    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DiaraBattle</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div id="game-container">
            <h1>Diara Battle</h1>
            <p>Welcome <?php echo $_SESSION["username"] ?></p>
            <div id="character-list">
                <!-- Exemple de cartes de personnages, à remplir dynamiquement avec JavaScript -->
            </div>
            <button id="summon-button" class="button">Faire une invocation</button>
            <button id="battle-button" class="button">Combattre</button>
            <button id="box-button" class="button"><a href="box.php">Ma box</a></button>
            <button id="logout" class="button"><a href="logout.php">Déconnexion</a></button>
            <div id="battle-log"></div>
        </div>

        <script>
            // Ici, tu ajouteras le JavaScript pour gérer les interactions de l'utilisateur et les appels AJAX vers le backend.
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: index.php");
    exit;
}
?>