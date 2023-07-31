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
            $user_id = $_SESSION['user_id'];
            $api_url = "http://votre-api.com/api.php?demande=personnages/$user_id";

            // Utilisation de cURL pour effectuer la requête à l'API
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $api_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($http_code == 200) {
                $characterDetails = json_decode($response, true);

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
            } else {
                echo "Erreur lors de la récupération des données depuis l'API.";
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
