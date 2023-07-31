<!DOCTYPE html>
<html>
<head>
    <title>Équipe de combat</title>
</head>
<body>
    <h1>Équipe de combat</h1>
    <?php
        // Vérifiez si l'utilisateur est connecté et récupérez son user_id
        session_start();
        if (!isset($_SESSION['user_id'])) {
            echo "Vous devez être connecté pour accéder à cette page.";
            exit;
        }

        // Vérifiez si des personnages ont été sélectionnés
        if (isset($_POST['selected_characters']) && !empty($_POST['selected_characters'])) {
            // Obtenez les personnages sélectionnés et affichez-les sous forme de tableau
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                    </tr>";
            foreach ($_POST['selected_characters'] as $selected_character_id) {
                // Vous pouvez également utiliser l'API pour obtenir plus d'informations sur chaque personnage ici
                echo "<tr>
                        <td>$selected_character_id</td>
                        <td>Personnage $selected_character_id</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "Aucun personnage sélectionné. Veuillez retourner à la page précédente et en sélectionner au moins un.";
        }
    ?>
</body>
</html>
