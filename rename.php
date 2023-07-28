<?php
// Remplace les valeurs suivantes par celles de ta base de données
$serveur = "localhost";
$utilisateur = "krpi8598_admin";
$mot_de_passe = "Afrique2015";
$nom_base_de_donnees = "krpi8598_diarabattle";

// Connexion à la base de données
$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees);

// Vérification de la connexion
if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}
