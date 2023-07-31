<?php
session_start();
if (isset($_SESSION['username'])) {
    $user_id = $_SESSION['user_id'];
    $api_url = "./api/characters/$user_id";

    // Utilisation de file_get_contents pour accéder à l'API
    $characters_json = file_get_contents($api_url);
    $characterDetails = json_decode($characters_json, true);

    if ($characterDetails !== null) {
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
            // Boucle pour afficher les informations de chaque personnage
            foreach ($characterDetails as $character) {
                $hp_affiche = $character['hp'] * pow((1 + ($character['lvl'] / 100)), 2);
                $puissance_affiche = $character['power'] * pow((1 + ($character['lvl'] / 100)), 2);
                $def_affiche = $character['defense'] * pow((1 + ($character['lvl'] / 100)), 2);
            ?>
                <li>
                    <?php echo htmlspecialchars($character['name']); ?><br>
                    Puissance: <?php echo number_format($puissance_affiche, 2); ?><br>
                    Défense: <?php echo number_format($def_affiche, 2); ?><br>
                    HP: <?php echo number_format($hp_affiche, 2); ?><br>
                    Niveau: <?php echo $character['lvl']; ?><br>
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
        echo "Erreur lors de la récupération des données depuis l'API.";
    }
} else {
    header("Location: index.php");
    exit;
}
?>
