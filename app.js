document.addEventListener("DOMContentLoaded", () => { 
    // Requête Fetch pour récupérer tous les niveaux depuis l'API
    fetch("app/api/get_niveaux.php")
        .then(response => response.json())
        .then(data => {
            const niveauxList = document.getElementById("niveaux-list");

            // Effacer le contenu précédent de la liste
            niveauxList.innerHTML = "";

            // Afficher les niveaux récupérés
            data.forEach(niveau => {
                const niveauItem = document.createElement("li");
                const niveauLink = document.createElement("a");
                niveauLink.textContent = niveau.categorie + " - " + niveau.difficulte;
                niveauLink.href = "select_team.php?niveau_id=" + niveau.id;

                niveauItem.appendChild(niveauLink);
                niveauxList.appendChild(niveauItem);
            });
        })
        .catch(error => console.error("Erreur lors de la récupération des niveaux :", error));
});