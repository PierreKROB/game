<?php 
session_start();
if (!isset($_SESSION['username'])){

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
        <section>
            <div class="color"></div>
            <div class="color"></div>
            <div class="color"></div>
            <div class="box">
                <div class="square" style="--i:0;"></div>
                <div class="square" style="--i:1;"></div>
                <div class="square" style="--i:2;"></div>
                <div class="square" style="--i:3;"></div>
                <div class="square" style="--i:4;"></div>
                <div class="container">
                    <div class="form">
                        <h2>Connexion</h2>
                        <form method="post" action="app/http/auth.php">
                            <div class="inputBox">
                                <input type="text" placeholder="Pseudo" name="username">
                            </div>
                            <div class="inputBox">
                                <input type="password" placeholder="Mot de passe" name="password">
                            </div>
                            <div class="inputBox">
                                <input type="submit" value="Connexion">
                            </div>
                            <p class="forget">Mot de passe oublié ? <a href="#">Clique ici</a></p>
                            <p class="forget">Pas de compte ? <a href="signup.php">Inscription</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
</body>

</html>
<?php 
}
else{
    header("Location: home.php");
    exit;
}
?>