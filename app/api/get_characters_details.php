<?php
// Inclure le fichier db.conn.php pour se connecter à la base de données
include_once 'db.conn.php';

// Récupérer les IDs des personnages sélectionnés depuis le paramètre GET "ids"
if (isset($_GET['ids'])) {

    // Préparer la requête SQL pour récupérer les détails des personnages sélectionnés
    // Utilisez une requête préparée pour éviter les injections SQL
    $ids = explode(',', $_GET['ids']);
    $placeholders = rtrim(str_repeat('?, ', count($ids)), ', ');
    $sql = "SELECT * FROM personnages WHERE id IN ($placeholders)";

    // Utiliser PDO pour exécuter la requête préparée
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($ids);
        $selected_characters = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Convertir le résultat en format JSON
        $selected_characters_json = json_encode(array_values($selected_characters));

        // Envoyer la réponse JSON
        header('Content-Type: application/json');
        echo $selected_characters_json;
    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Erreur lors de la récupération des détails des personnages depuis la base de données.'));
    }

    // Fermer la connexion à la base de données
    $conn = null;
} else {
    // Si aucun ID de personnage n'a été fourni, renvoyer une réponse d'erreur
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Aucun ID de personnage fourni.'));
}
