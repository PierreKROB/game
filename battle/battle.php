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
            var_dump($personnages_ids);
            // Inclure le fichier de connexion à la base de données
            include_once 'db.conn.php';

            // Préparer la requête SQL pour récupérer les détails des personnages sélectionnés
            $placeholders = rtrim(str_repeat('?, ', count($personnages_ids)), ', ');
            $sql = "SELECT * FROM personnages WHERE id IN ($placeholders)";
            $stmt = $conn->prepare($sql);
            $stmt->execute($personnages_ids);
            $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($characters) > 0) {
                // Afficher les informations des personnages sélectionnés
                echo "<ul>";
                foreach ($characters as $character) {
                    echo "<li>";
                    echo "Nom : " . $character['nom'] . "<br>";
                    echo "Niveau : " . $character['niveau'] . "<br>";
                    echo "Puissance : " . $character['puissance'] . "<br>";
                    // Affichez d'autres informations que vous avez dans le résultat de la requête
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "Aucun personnage trouvé pour les IDs sélectionnés.";
            }

            // Fermer la connexion à la base de données
            $conn = null;
        } else {
            echo "<p>Aucun personnage n'a été sélectionné pour la bataille.</p>";
        }
        ?>

        <a href="../home.php">Revenir à la sélection d'équipe</a>
    </div>

</body>

</html>
