<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selected_characters']) && isset($_POST['niveau_id'])) {
        $selected_characters = $_POST['selected_characters'];
        $niveau_id = $_POST['niveau_id'];

        // Obtenir la liste des personnages sélectionnés
        $selected_characters_info = array();

        foreach ($selected_characters as $character_id) {
            $api_url = "https://eligoal.com/game/api/characters/$character_id";
            $character_json = file_get_contents($api_url);
            $character_info = json_decode($character_json, true);

            // Ajouter les informations du personnage (y compris les HP) à la liste
            if (!empty($character_info)) {
                $selected_characters_info[] = $character_info;
            }
        }

        // Calculer les HP totaux de l'équipe
        $total_hp = 0;

        foreach ($selected_characters_info as $character_info) {
            $total_hp += $character_info['hp'];
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
    <title>Équipe de combat</title>
</head>

<body>
    <h1>Équipe de combat</h1>
    <?php if (isset($total_hp)) : ?>
        <p>Montant total des points de vie de l'équipe : <?php echo $total_hp; ?></p>
    <?php endif; ?>
    <!-- Afficher d'autres informations sur l'équipe de combat si nécessaire -->
</body>

</html>
