<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selected_characters']) && isset($_POST['niveau_id'])) {
        $selected_characters = $_POST['selected_characters'];
        $niveau_id = $_POST['niveau_id'];

        foreach ($selected_characters as $selected_character_json) {
            $selected_character = json_decode($selected_character_json, true);

            // Obtenir les statistiques de base du personnage
            $base_hp = $base_hp + $selected_character['hp'];
        }
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
    <?php if (isset($base_hp)) : ?>
        <p>Montant total des points de vie de l'équipe : <?php echo $base_hp; ?></p>
    <?php endif; ?>

</body>

<script>
    // Passer l'ID du niveau à battle.js en tant que variable JavaScript
    var niveauId = <?php echo $niveau_id; ?>;
</script>
<script src="battle.js"></script>
</html>
