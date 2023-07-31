<?php
session_start();
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sélection d'équipe</title>
</head>
<body>
    <h1>Sélectionnez votre équipe</h1>
    <form action="battle.php" method="post">
        <?php
            // Vérifiez si l'utilisateur est connecté et récupérez son user_id
            

            // Récupérez l'ID du niveau depuis l'URL
            if (isset($_GET['niveau_id'])) {
                $niveau_id = $_GET['niveau_id'];
            } else {
                // Gérer le cas où l'ID du niveau est manquant
                echo "Erreur : l'ID du niveau est manquant.";
                exit();
            }

            // Obtenez la liste des personnages du joueur via l'API
            $api_url = "https://eligoal.com/game/api/player_characters/$user_id";
            $characters_json = file_get_contents($api_url);
            $characters = json_decode($characters_json, true);

            // Vérifiez si des personnages ont été récupérés
            if (empty($characters)) {
                echo "Aucun personnage trouvé pour cet utilisateur.";
            } else {
                // Affichez les cases à cocher pour chaque personnage
                foreach ($characters as $character) {
                    $character_id = $character['id'];
                    $character_name = $character['name'];
                    echo "<input type=\"checkbox\" name=\"selected_characters[]\" value=\"$character_id\"> $character_name <br>";
                }
                echo "<br>";

                // Inclure l'ID du niveau dans le formulaire
                echo "<input type=\"hidden\" name=\"niveau_id\" value=\"$niveau_id\">";

                echo "<input type=\"submit\" value=\"Valider\">";
            }
        ?>
    </form>
</body>
</html>
