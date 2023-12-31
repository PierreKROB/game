<?php
session_start();

$base_hp = 0; // Initialise la variable $base_hp

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selected_characters']) && isset($_POST['niveau_id'])) {
        $selected_characters = $_POST['selected_characters'];
        $niveau_id = $_POST['niveau_id'];
    } else {
        echo "Erreur : les personnages sélectionnés ou l'ID du niveau sont manquants.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Combat !</title>
</head>

<body>
    <h1>Équipe de combat</h1>
    <!-- Affichez le total des HP du joueur -->
    <!-- Créez un élément HTML pour afficher les HP -->
    <p>HP du joueur : <span id="hpDisplay"></span></p>



    <h2>Ennemis du niveau</h2>
    <ul id="ennemis-list">
        <!-- Les ennemis seront ajoutés ici dynamiquement -->
    </ul>


    <?php
    // Convertir le tableau des joueurs en JSON
    $joueurs_json = json_encode($selected_characters);
    ?>
    <script>
        var joueursData = <?php echo $joueurs_json ?>;
        var niveauId = <?php echo $niveau_id; ?>;
    </script>

    <script src="battle.js"></script>



</body>


</html>