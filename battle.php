<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bataille</title>
</head>

<body class="body">

    <div>
        <h1>Votre équipe pour la bataille</h1>
        <p>Voici les personnages que vous avez sélectionnés pour affronter le niveau :</p>

        <?php
        // Vérifier si des personnages ont été sélectionnés
        if (isset($_POST['personnages'])) {
            $personnages_ids = $_POST['personnages'];

            // Faire une requête à l'API pour obtenir les détails des personnages sélectionnés
            // Assurez-vous de remplacer "app/api/get_character_details.php" par l'URL réelle de votre API
            $url = "app/api/get_characters_details.php?ids=" . implode(',', $personnages_ids);
            $response = file_get_contents($url);

            if ($response !== false) {
                $characters = json_decode($response, true);

                // Afficher les informations des personnages sélectionnés
                echo "<ul>";
                foreach ($characters as $character) {
                    echo "<li>";
                    echo "Nom : " . $character['nom'] . "<br>";
                    echo "Niveau : " . $character['niveau'] . "<br>";
                    echo "Puissance : " . $character['puissance'] . "<br>";
                    // Affichez d'autres informations que vous avez dans la réponse JSON
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "Erreur lors de la récupération des détails des personnages depuis l'API.";
            }
        } else {
            echo "<p>Aucun personnage n'a été sélectionné pour la bataille.</p>";
        }
        ?>

        <a href="home.php">Revenir à la sélection d'équipe</a>
    </div>

</body>

</html>
