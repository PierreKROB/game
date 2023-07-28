<?php
# Inclure le fichier de connexion à la base de données
include '../db.conn.php';

# Requête pour récupérer tous les personnages de la table "personnages"
$sql = "SELECT * FROM personnages";
$stmt = $conn->prepare($sql);
$stmt->execute();

# Récupérer les résultats de la requête sous forme de tableau associatif
$characters = $stmt->fetchAll(PDO::FETCH_ASSOC);

# Renvoyer les données au format JSON
header('Content-Type: application/json');
echo json_encode($characters);
?>
