<?php
# Inclure le fichier de connexion à la base de données
include '../db.conn.php';

# Requête pour récupérer tous les niveaux depuis la table `niveau`
$sql_get_niveaux = "SELECT * FROM niveau";
$stmt_get_niveaux = $conn->prepare($sql_get_niveaux);
$stmt_get_niveaux->execute();

# Récupérer les données des niveaux dans un tableau associatif
$niveaux = $stmt_get_niveaux->fetchAll(PDO::FETCH_ASSOC);

# Répondre avec les données des niveaux au format JSON
header('Content-Type: application/json');
echo json_encode($niveaux);
