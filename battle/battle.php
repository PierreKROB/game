<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selected_characters']) && isset($_POST['niveau_id'])) {
        $selected_characters = $_POST['selected_characters'];
        $niveau_id = $_POST['niveau_id'];

        // Calculer les HP totaux de l'équipe en utilisant la formule donnée
        $total_hp = 0;

        foreach ($selected_characters as $selected_character_json) {
            $selected_character = json_decode($selected_character_json, true);

            // Obtenir les statistiques de base du personnage
            $base_hp = $selected_character['hp'];

            // Obtenir le niveau du personnage (vous devez récupérer le niveau du personnage depuis la base de données ou autre source)
            // Pour cet exemple, on suppose que le niveau du personnage est 1
            $niveau_personnage = 100;

            // Calculer la statistique HP du personnage en utilisant la formule donnée
            $multiplicateur_doublon = 1.0; // Vous devez définir le multiplicateur de doublon pour chaque personnage
            $stat_hp = $base_hp * pow((1 + $niveau_personnage / 100), 2) * $multiplicateur_doublon;

            // Ajouter la statistique HP calculée au total des HP de l'équipe
            $total_hp += $stat_hp;
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
