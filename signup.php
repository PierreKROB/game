<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body class="body">

    <div>
        <div>
            <form method="post" action="app/http/signup.php">

                <!-- <div>
                    <img src="img/logo.png" class="w-full h-40" alt="Logo">
                </div> -->

                <div>
                    <div>
                        <label>
                            Prénom
                        </label>
                        <input type="text" name="firstname">
                    </div>

                    <div>
                        <label>
                            Nom
                        </label>
                        <input type="text" name="lastname">
                    </div>

                    <button type="submit">S'inscrire</button>

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

                    <div>
                        <a href="index.php">Connexion</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</body>

</html>