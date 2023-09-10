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
            <p>Bienvenue <?php echo $_SESSION["username"] ?></p>
            <!-- À l'intérieur de votre div #game-container -->
            <!-- <div id="game-box" class="box">
                <h2>Afk-battle</h2>
                <?php 
                    // include_once "afk-battle/afk-battle.php";
                ?>
            </div> -->

        </div>
        <div class="button-container">
            <button id="summon-button" class="button">Invocation</button>
            <button id="battle-button" class="button"><a href="battle/select_lvl.php">Combattre</a></button>
            <button id="box-button" class="button"><a href="box.php">Box</a></button>
            <button id="logout" class="button"><a href="logout.php">Déconnexion</a></button>
        </div>

        <div id="battle-log"></div>
        </div>

    </body>

    </html>
<?php
} else {
    header("Location: index.php");
    exit;
}
?>