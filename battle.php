<?php
session_start();

# Vérifier si des personnages ont été sélectionnés pour l'équipe
if (isset($_POST['personnages']) && is_array($_POST['personnages']) && !empty($_POST['personnages'])) {
    # Récupérer les identifiants des personnages sélectionnés
    $personnages_ids = $_POST['personnages'];

    # Vous pouvez maintenant utiliser $personnages_ids pour obtenir les détails des personnages depuis la base de données
    # Par exemple, vous pouvez effectuer une requête SQL pour récupérer les détails des personnages sélectionnés

    # Pour cet exemple, nous allons simplement afficher les identifiants des personnages sélectionnés
    echo "<h1>Équipe sélectionnée :</h1>";
    echo "<ul>";
    foreach ($personnages_ids as $personnage_id) {
        echo "<li>Personnage ID : $personnage_id</li>";
    }
    echo "</ul>";
} else {
    echo "<h1>Aucun personnage sélectionné pour l'équipe</h1>";
}
?>
