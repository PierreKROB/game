<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Équipe de combat</title>
</head>

<body>
    <h1>Équipe de combat</h1>
    <?php
    // Vérifiez si des personnages ont été sélectionnés
    if (isset($_POST['selected_characters']) && !empty($_POST['selected_characters'])) {
        $user_id = $_SESSION['user_id'];
        $api_url = "https://eligoal.com/game/api/player_characters/$user_id";

        // Utilisation de file_get_contents pour accéder à l'API
        $characters_json = file_get_contents($api_url);
        $characterDetails = json_decode($characters_json, true);


        echo "HP: $HP";
        foreach ($_POST['selected_characters'] as $selected_character_id) {
            // Vous pouvez également utiliser l'API pour obtenir plus d'informations sur chaque personnage ici
        }
    } else {
        echo "Aucun personnage sélectionné. Veuillez retourner à la page précédente et en sélectionner au moins un.";
    }
    ?>
</body>

</html>