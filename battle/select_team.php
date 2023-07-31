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
            <!-- Afficher le niveau sélectionné -->
            <?php
            if (isset($niveau_id)) {
                echo "<p>Vous avez choisi le niveau $niveau_id.</p>";
            }
            ?>

            <label for="personnages">Sélectionnez vos personnages :</label>
            <select name="personnages[]" id="personnages" multiple>
                <!-- Ici, tu devrais récupérer les personnages depuis l'API et les afficher sous forme d'options -->
                <!-- Par exemple, tu peux utiliser une boucle pour afficher tous les personnages disponibles -->
                <?php
                // Remplacez cette partie par une requête à l'API pour récupérer les personnages
                // et les afficher sous forme d'options dans le menu déroulant.
                $personnages = array(
                    array('id' => 1, 'name' => 'Personnage 1'),
                    array('id' => 2, 'name' => 'Personnage 2'),
                    array('id' => 3, 'name' => 'Personnage 3')
                );

                foreach ($personnages as $personnage) {
                    echo "<option value='" . $personnage['id'] . "'>" . $personnage['name'] . "</option>";
                }
                ?>
            </select>

            <input type="submit" value="Commencer la bataille">
        </form>

    </div>

</body>

</html>


            <!-- Utiliser un champ caché pour envoyer le niveau_id avec le formulaire
            <input type="hidden" name="niveau_id" value='<?php echo $niveau_id; ?>'>

           
            <input type="hidden" id="selected_characters" name="personnages" value="">

        
            <ul id="characters-list">
         
            </ul>

            <button type="submit">Démarrer le niveau</button>
        </form>
    </div>

    <script>
        // Requête Fetch pour récupérer tous les personnages depuis l'API
        fetch("../app/api/get_characters_player.php")
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
                    characterCheckbox.value = personnage.id_perso;

                    characterLabel.appendChild(characterCheckbox);
                    characterItem.appendChild(characterLabel);
                    charactersList.appendChild(characterItem);
                });
            })
            .catch(error => console.error("Erreur lors de la récupération des personnages :", error));

        // Nouveau code pour gérer l'envoi des personnages sélectionnés
        const form = document.querySelector('form');
        const selectedCharactersInput = document.getElementById('selected_characters');

        form.addEventListener('submit', function(event) {
            const selectedCharacters = Array.from(
                document.querySelectorAll('input[name="personnages[]"]:checked')
            ).map(characterCheckbox => characterCheckbox.value);

            selectedCharactersInput.value = selectedCharacters.join(',');
        });
    </script>
</body>

</html> -->
