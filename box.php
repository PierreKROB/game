<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des personnages</title>
</head>

<body>

    <div>
        <h2>Liste des personnages</h2>
        <ul id="characterList">
            <!-- La liste des personnages sera affichée ici -->
        </ul>
    </div>

    <script>
        // Fonction pour afficher les personnages dans la liste
        function afficherPersonnages(personnages) {
            const characterList = document.getElementById('characterList');

            // Effacer le contenu précédent de la liste
            characterList.innerHTML = '';

            // Parcourir chaque personnage et les ajouter à la liste
            personnages.forEach(personnage => {
                const listItem = document.createElement('li');
                listItem.textContent = personnage.nom; // Changer ici pour afficher d'autres détails du personnage
                characterList.appendChild(listItem);
            });
        }

        // Fonction pour récupérer les personnages depuis l'API
        function getPersonnages() {
            fetch('app/api/get_characters.php')
                .then(response => response.json())
                .then(data => afficherPersonnages(data))
                .catch(error => console.error('Erreur lors de la récupération des personnages:', error));
        }

        // Appeler la fonction pour récupérer les personnages au chargement de la page
        getPersonnages();
    </script>

</body>

</html>