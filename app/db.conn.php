<?php

# Nom du serveur
$sName = "localhost";
# Nom d'utilisateur
$uName = "root";
# Mot de passe
$pass = "root";
# Nom de la base de données
$db_name = "krpi8598_diarabattle";

# Création de la connexion à la base de données
try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name;charset=utf8", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
}
