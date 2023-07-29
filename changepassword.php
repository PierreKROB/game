<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouveaux mots de passe depuis le formulaire
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Vérifications de validation et de sécurité
    if (empty($newPassword) || empty($confirmPassword)) {
        $error = '<div class="flex justify-center bg-red-200 text-yellow-800 p-3 rounded">
    Veuillez remplir tous les champs.
  </div>';
    } elseif ($newPassword !== $confirmPassword) {
        $error = "Les nouveaux mots de passe ne correspondent pas.";
    } else {    
        include 'app/db.conn.php';
        try {
            $conn = new PDO("mysql:host=$sName;dbname=$db_name;charset=utf8", $uName, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connexion échouée : " . $e->getMessage();
        }

        // Hasher le nouveau mot de passe
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe dans la table "joueurs" pour l'utilisateur actuel
        $userId = $_SESSION['rotabois'];
        $sql = "UPDATE joueurs SET mot_de_passe=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$hashedPassword, $userId]);


        $sqlReset = "UPDATE joueurs SET new=0 WHERE id=?";
        $stmtReset = $conn->prepare($sqlReset);
        $stmtReset->execute([$userId]);

        // Redirection vers la page de connexion avec un message de succès
        header("Location: index.php?success=Votre mot de passe a été modifié avec succès.");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer le mot de passe</title>
</head>

<body>
    <div name="container">
        <div name="inputs">
            <h2>Changer le mot de passe</h2>
            <form method="POST" action="">
                <div name="new-mdp">
                    <label for="new_password">Nouveau mot de passe :</label><br>
                    <input type="password" id="new_password" name="new_password"><br><br>
                </div>
                <div name="new-mdp-confirm">
                    <label for="confirm_password">Confirmez le nouveau mot de passe :</label><br>
                    <input type="password" id="confirm_password" name="confirm_password"><br><br>
                </div>
                <?php if (isset($error)) : ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
                <div name="interaction">
                    <input type="submit" value="Appliquer les changements">
                </div>
            </form>
        </div>
    </div>
</body>

</html>