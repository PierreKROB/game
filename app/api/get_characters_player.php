<?php
# Inclure le fichier de connexion à la base de données
include '../db.conn.php';
session_start();
# Requête pour récupérer tous les personnages de la table "personnages"
$user_id = $_SESSION['user_id'];
# Requête pour récupérer tous les personnages
$sql = "SELECT id, nom, puissance, defense, HP, box.niveau_actuel AS lvl FROM personnages Join box on personnages.id = box.personnage_id WHERE box.joueur_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);

# Récupérer les résultats de la requête sous forme de tableau associatif
$characters = $stmt->fetchAll(PDO::FETCH_ASSOC);

# Renvoyer les données au format JSON
header('Content-Type: application/json');
echo json_encode($characters);
