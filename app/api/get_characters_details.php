<?php
// Inclure le fichier db.conn.php pour se connecter à la base de données
include_once 'db.conn.php';

// Récupérer les IDs des personnages sélectionnés depuis le paramètre GET "ids"
if (isset($_GET['ids'])) {

    // Vérifier si la connexion a réussi
    if (!$conn) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Impossible de se connecter à la base de données.'));
        exit;
    }

    $ids = explode(',', $_GET['ids']);

    // Préparer la requête SQL pour récupérer les détails des personnages sélectionnés
    // Utilisez une requête préparée pour éviter les injections SQL
    $sql = "SELECT * FROM personnages WHERE id IN (" . implode(',', $ids) . ")";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $selected_characters = array();

        // Récupérer les résultats de la requête et les stocker dans un tableau
        while ($row = mysqli_fetch_assoc($result)) {
            $selected_characters[] = $row;
        }

        // Convertir le résultat en format JSON
        $selected_characters_json = json_encode(array_values($selected_characters));

        // Envoyer la réponse JSON
        header('Content-Type: application/json');
        echo $selected_characters_json;
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Erreur lors de la récupération des détails des personnages depuis la base de données.'));
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
} else {
    // Si aucun ID de personnage n'a été fourni, renvoyer une réponse d'erreur
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Aucun ID de personnage fourni.'));
}
