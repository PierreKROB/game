<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
} else {
    echo "<h1>Erreur : cette page ne peut être accédée directement</h1>";
}
?>
















// # Inclure le fichier de connexion à la base de données
// include '../db.conn.php';

// # Vérifier si l'identifiant du niveau a été passé en paramètre dans l'URL
// if (isset($_GET['niveau_id'])) {
//     $niveau_id = $_GET['niveau_id'];

//     # Requête pour récupérer les détails du niveau à partir de l'identifiant
//     $sql = "SELECT * FROM niveau WHERE id = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute([$niveau_id]);

//     # Vérifier si le niveau existe
//     if ($stmt->rowCount() === 1) {
//         $niveau = $stmt->fetch(PDO::FETCH_ASSOC);

//         # Récupérer la liste des boss du niveau (sous forme de tableau)
//         $liste_boss = json_decode($niveau['liste_boss'], true);

//         # Vérifier si le joueur a des personnages dans sa box
//         $sql = "SELECT * FROM box WHERE joueur_id = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->execute([$joueur_id]);

//         # Vérifier si le joueur a des personnages dans sa box
//         if ($stmt->rowCount() > 0) {
//             $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);

//             # Redirection vers la page de sélection d'équipe avec les détails du niveau et les personnages du joueur
//             header("Location: ../../battle.php?niveau_id=$niveau_id&niveau_categorie={$niveau['categorie']}&niveau_difficulte={$niveau['difficulte']}&liste_boss=" . urlencode(json_encode($liste_boss)) . "&characters=" . urlencode(json_encode($characters)));
//         } else {
//             # Redirection vers la page de sélection de niveau avec un message d'erreur
//             header("Location: battle.php?error=Aucun_personnage_disponible");
//         }
//     } else {
//         # Redirection vers la page de sélection de niveau avec un message d'erreur
//         header("Location: battle.php?error=Niveau_non_trouve");
//     }
// } else {
//     # Redirection vers la page de sélection de niveau avec un message d'erreur
//     header("Location: battle.php?error=Identifiant_niveau_manquant");
// }
