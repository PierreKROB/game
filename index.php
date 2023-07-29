<?php var_dump($_SESSION) ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body class="body">

    <div>
        <div>
            <form method="post" action="app/http/auth.php">

                <!-- <div>
                    <img src="img/logo.png" class="w-full h-40" alt="Logo">
                </div> -->

                <div>
                    <div>
                        <label>
                            Pseudo
                        </label>
                        <input type="text" name="username">
                    </div>

                    <div>
                        <label>
                            Mot de passe
                        </label>
                        <input type="password" name="password">
                    </div>

                    <button type="submit">Connexion</button>

                    <?php if (isset($_GET['error'])) { ?>
                        <div class="bg-yellow-200 text-yellow-800 p-3 rounded mb-4">
                            <?php echo htmlspecialchars($_GET['error']); ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <div class="bg-green-200 text-green-800 p-3 rounded">
                            <?php echo htmlspecialchars($_GET['success']); ?>
                        </div>
                    <?php } ?>

                </div>
            </form>
            <!-- Lien vers la page d'inscription "signup.php" -->
            <div>
                <a href="signup.php">Inscription</a>
            </div>
        </div>
    </div>
</body>

</html>
