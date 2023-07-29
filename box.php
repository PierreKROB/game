<?php
session_start();
if (isset($_SESSION['username'])) {
    
?>


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
            $user_id = $_SESSION['user_id'];
            # Requête pour récupérer tous les personnages
            $sql = "SELECT nom, puissance, defense, HP, box.niveau_actuel AS lvl FROM personnages Join box on personnages.id_perso = box.personnage_id WHERE box.joueur_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$user_id]);

            # Boucle pour afficher les informations de chaque personnage
            while ($row = $stmt->fetch()) {
                $hp_affiche = $row['HP']* (1+($row['lvl'])/100)**2;
                $puissance_affiche = $row['puissance']* (1+($row['lvl'])/100)**2;
                $def_affiche = $row['defense']* (1+($row['lvl'])/100)**2;
            ?>
                <li>
                    <?php echo htmlspecialchars($row['nom']); ?><br>
                    Puissance: <?php echo $puissance_affiche; ?><br>
                    Défense: <?php echo $def_affiche; ?><br>
                    HP: <?php echo $hp_affiche; ?><br>
                    Niveau: <?php echo $row['lvl']; ?><br>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>

</body>

</html>

<?php
} else {
    header("Location: index.php");
    exit;
}
?>