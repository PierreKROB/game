<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Combat en temps réel</title>
</head>
<body>
    <div>
        <h1>Combat en temps réel</h1>
        <div>
            <h2>Joueur</h2>
            <div>
                <p>Nom : <span id="player-name">Joueur 1</span></p>
                <p>Points de vie : <span id="player-hp">100</span></p>
            </div>
            <button id="attack-button">Attaquer</button>
        </div>
        <div>
            <h2>Adversaire</h2>
            <div>
                <p>Nom : <span id="enemy-name">Adversaire 1</span></p>
                <p>Points de vie : <span id="enemy-hp">100</span></p>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour mettre à jour les points de vie affichés
        function updateHP(character, hp) {
            if (character === 'player') {
                document.getElementById('player-hp').textContent = hp;
            } else if (character === 'enemy') {
                document.getElementById('enemy-hp').textContent = hp;
            }
        }

        // Fonction pour gérer l'attaque
        function attack() {
            // Ici, vous enverrez une requête AJAX à l'API pour calculer les dégâts infligés à l'adversaire
            // et mettez à jour les points de vie en conséquence
            // Remplacez cette partie par votre propre code
            let playerHP = parseInt(document.getElementById('player-hp').textContent);
            let enemyHP = parseInt(document.getElementById('enemy-hp').textContent);

            // Exemple de dégâts infligés (vous pouvez remplacer cette partie par votre propre logique de combat)
            let damage = Math.floor(Math.random() * 20) + 10;
            enemyHP -= damage;

            updateHP('enemy', enemyHP);

            // Vérifiez si l'adversaire est vaincu
            if (enemyHP <= 0) {
                alert('L\'adversaire a été vaincu !');
            }
        }

        // Événement pour l'attaque lorsque le bouton est cliqué
        document.getElementById('attack-button').addEventListener('click', () => {
            attack();
        });

        // Répétez la requête AJAX périodiquement pour mettre à jour les points de vie en temps réel
        setInterval(() => {
            // Ici, vous enverrez une requête AJAX à l'API pour récupérer les points de vie des combattants
            // et mettez à jour l'interface en conséquence
            // Remplacez cette partie par votre propre code
            let playerHP = parseInt(document.getElementById('player-hp').textContent);
            let enemyHP = parseInt(document.getElementById('enemy-hp').textContent);

            // Exemple de mise à jour des points de vie (vous pouvez remplacer cette partie par votre propre logique de récupération)
            playerHP -= 5;
            enemyHP -= 3;

            // Mettez à jour l'interface avec les nouvelles valeurs de points de vie
            updateHP('player', playerHP);
            updateHP('enemy', enemyHP);

            // Vérifiez si l'un des combattants est vaincu
            if (playerHP <= 0 || enemyHP <= 0) {
                alert('Le combat est terminé !');
                // Ici, vous pouvez effectuer d'autres actions après la fin du combat
            }
        }, 1000); // Répétez toutes les 1000 millisecondes (1 seconde)
    </script>
</body>
</html>
