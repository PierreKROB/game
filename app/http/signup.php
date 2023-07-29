<?php

if (isset($_POST['firstname']) && isset($_POST['lastname'])) {

   include '../db.conn.php';
   include 'create_password.php';

   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];

   $username = strtolower(substr($firstname, 0, 1)) . strtolower($lastname);
   $name = $firstname . ' ' . $lastname;

   if (empty($name)) {
      $em = "Le nom est requis";
      header("Location: ../../signup.php?error=$em");
      exit;
   } else if (empty($username)) {
      $em = "Le nom d'utilisateur est requis";
      header("Location: ../../signup.php?error=$em");
      exit;
   } else {
      $sql_check_username = "SELECT id FROM joueurs WHERE nom=?";
      $stmt_check_username = $conn->prepare($sql_check_username);
      $stmt_check_username->execute([$username]);

      if ($stmt_check_username->rowCount() > 0) {
         $em = "Le nom d'utilisateur ($username) est déjà pris";
         header("Location: ../../signup.php?error=$em");
         exit;
      } else {
         $password = randomMDP();

         $contenuFichier = "Utilisateur: $username   Mot de passe temporaire: $password\n";
         $cheminFichier = "compt.txt";
         file_put_contents($cheminFichier, $contenuFichier, FILE_APPEND);

         $password = password_hash($password, PASSWORD_DEFAULT);

         $sql = "INSERT INTO joueurs (nom, mot_de_passe) VALUES (?, ?)";
         $stmt = $conn->prepare($sql);
         $stmt->execute([$name, $password]);

         $sm = "Compte créé avec succès et feur";
         header("Location: ../../index.php?success=$sm");
         exit;
      }
   }
} else {
	$em = "Il faut remplir les champs";
   header("Location: ../../signup.php?error=$em");
   exit;
}

?>
