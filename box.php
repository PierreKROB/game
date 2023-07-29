<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des personnages</title>
</head>

<body class="body">

    <div>
        <h1>Liste des personnages</h1>

        <ul>
            <?php
            # Fichier de connexion à la base de données
            include 'app/db.conn.php';

            # Requête pour récupérer tous les personnages
            $sql = "SELECT id, nom, puissance, niveau, experience, defense FROM personnages";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            # Boucle pour afficher les informations de chaque personnage
            while ($row = $stmt->fetch()) {
                $hp_affiche = ($row['niveau'] * 0.03) * $row['hp']; // Calcul des HP affichés
            ?>
                <li>
                    <?php echo htmlspecialchars($row['nom']); ?> (ID: <?php echo $row['id']; ?>)<br>
                    Puissance: <?php echo $row['puissance']; ?><br>
                    Niveau: <?php echo $row['niveau']; ?><br>
                    Expérience: <?php echo $row['experience']; ?><br>
                    Défense: <?php echo $row['defense']; ?><br>
                    HP: <?php echo $hp_affiche; ?> <!-- Affichage des HP calculés -->
                </li>
            <?php
            }
            ?>
        </ul>
    </div>

</body>

</html>