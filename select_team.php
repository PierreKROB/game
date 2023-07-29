<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélection d'équipe</title>
</head>

<body class="body">

    <div>
        <h1>Sélectionnez votre équipe</h1>
        <p>Choisissez les personnages que vous souhaitez inclure dans votre équipe pour affronter le niveau.</p>

        <form method="post" action="battle.php">

            <!-- Récupérer le niveau sélectionné depuis l'URL -->
            <?php
            if (isset($_GET['niveau_id'])) {
                $niveau_id = $_GET['niveau_id'];
            }
            ?>

            <!-- Utiliser un champ caché pour envoyer le niveau_id avec le formulaire -->
            <input type="hidden" name="niveau_id" value="<?php echo $niveau_id; ?>">

            <!-- Afficher la liste des personnages disponibles -->
            <ul id="characters-list">
                <!-- Les personnages seront générés dynamiquement ici via JavaScript -->
            </ul>

            <button type="submit">Démarrer le niveau</button>
        </form>
    </div>

    <script>
        // Requête Fetch pour récupérer tous les personnages depuis l'API
        fetch("app/api/get_characters_player.php")
            .then(response => {
                if (!response.ok) {
                    throw new Error("La requête a échoué : " + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log(data); // Afficher la réponse JSON dans la console

                const charactersList = document.getElementById("characters-list");

                // Afficher les personnages récupérés
                data.forEach(personnage => {
                    const characterItem = document.createElement("li");
                    const characterLabel = document.createElement("label");
                    characterLabel.textContent = personnage.nom;

                    // Créer un champ de sélection pour chaque personnage
                    const characterCheckbox = document.createElement("input");
                    characterCheckbox.type = "checkbox";
                    characterCheckbox.name = "personnages[]";
                    characterCheckbox.value = personnage.id;

                    characterLabel.appendChild(characterCheckbox);
                    characterItem.appendChild(characterLabel);
                    charactersList.appendChild(characterItem);
                });
            })
            .catch(error => console.error("Erreur lors de la récupération des personnages :", error));
    </script>
</body>

</html>
