<?php
session_start();

# vérifier si le nom d'utilisateur et le mot de passe ont été soumis
if (isset($_POST['username']) && isset($_POST['password'])) {

  # fichier de connexion à la base de données
  include '../db.conn.php';

  # récupérer les données de la requête POST et les stocker dans des variables
  $password = $_POST['password'];
  $username = $_POST['username'];

  # validation simple du formulaire
  if (empty($username)) {
    # message d'erreur
    $em = "Le nom d'utilisateur est requis";

    # rediriger vers 'index.php' en passant le message d'erreur
    header("Location: ../../index.php?error=$em");
  } else if (empty($password)) {
    # message d'erreur
    $em = "Le mot de passe est requis";

    # rediriger vers 'index.php' en passant le message d'erreur
    header("Location: ../../index.php?error=$em");
  } else {
    $sql = "SELECT * FROM joueurs WHERE nom=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);

    # si le nom d'utilisateur existe
    if ($stmt->rowCount() === 1) {
      # récupération des données de l'utilisateur
      $user = $stmt->fetch();

      # vérification du mot de passe crypté
      if (password_verify($password, $user['mot_de_passe'])) {
        # authentification réussie
        # création de la SESSION
        $_SESSION['username'] = $user['nom'];
        $_SESSION['user_id'] = $user['id'];

        # redirection vers 'home.php'
        header("Location: ../../home.php");
      } else {
        # message d'erreur
        $em = "Nom d'utilisateur ou mot de passe incorrect";

        # redirection vers 'index.php' en passant le message d'erreur
        header("Location: ../../index.php?error=$em");
      }
    }
    else {
      $em = "Nom d'utilisateur ou mot de passe incorrect";
      # redirection vers 'index.php' en passant le message d'erreur
      header("Location: ../../index.php?error=$em");
    }
  }
} else {
  header("Location: ../../index.php");
  exit;
}
?>
