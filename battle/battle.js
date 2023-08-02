// Importer les classes à partir des fichiers séparés
// import HP_TOTALplayer from './class/HP_TOTALplayer.js';
// import Ennemi from './class/Ennemi.js';
// Classe pour représenter les ennemis
class Ennemi {
  constructor(nom, hp, defense, attaque, attaque_speciale, dommage_reduit, type) {
    this.nom = nom;
    this.hp = hp;
    this.defense = defense;
    this.attaque = attaque;
    this.attaque_speciale = attaque_speciale;
    this.dommage_reduit = dommage_reduit;
    this.type = type;
  }

  // Méthode pour soigner l'ennemi
  HealEnnemi(montant) {
    this.hp += montant;
    // Vérifier si les points de vie de l'ennemi dépassent le maximum
    if (this.hp > this.hpMax) {
      this.hp = this.hpMax;
    }
  }

  // Méthode pour retirer des points de vie à l'ennemi
  DamageEnnemi(degats) {
    // Appliquer la réduction des dommages si elle est inférieure à 1
    const degatsReduits = degats * this.dommage_reduit;
    // Soustraire les points de vie de l'ennemi
    this.hp -= degatsReduits;
    // Vérifier si les points de vie de l'ennemi sont tombés en dessous de zéro
    if (this.hp < 0) {
      this.hp = 0;
    }
  }
}

// Classe HP_TOTALplayer
class HP_TOTALplayer {
  constructor(HP_MAX) {
    this.HP_MAX = HP_MAX;
    this.HP_NOW = HP_MAX;
  }

  // Méthode pour ajouter des points de vie
  HealPlayer(montant) {
    this.HP_NOW += montant;
    // Vérifier si les points de vie actuels ne dépassent pas le maximum
    if (this.HP_NOW > this.HP_MAX) {
      this.HP_NOW = this.HP_MAX;
    }
  }

  // Méthode pour retirer des points de vie
  DamagePlayer(montant) {
    this.HP_NOW -= montant; // Correction ici, utiliser this.HP_NOW au lieu de pointsDeVieActuels
    // Vérifier si les points de vie actuels sont tombés en dessous de zéro
    if (this.HP_NOW < 0) {
      this.HP_NOW = 0;
    }
  }
}

// Définir la fonction pour récupérer les ennemis du niveau
function getEnnemisDuNiveau(niveauId) {
  try {
    const url = `https://eligoal.com/game/api/niveaux/${niveauId}`;
    return fetch(url)
      .then(response => response.json())
      .then(data => {
        // Vérifier si la réponse de l'API contient bien une liste d'ennemis
        if (data && Array.isArray(data.liste_boss)) {
          // Renvoyer directement les ennemis récupérés
          return data.liste_boss;
        } else {
          console.error("Erreur lors de la récupération des ennemis du niveau.");
          return [];
        }
      })
      .catch(error => {
        console.error("Erreur lors de la récupération des ennemis du niveau :", error);
        return [];
      });
  } catch (error) {
    console.error("Erreur lors de la récupération des ennemis du niveau :", error);
    return [];
  }
}

// Déclarez la variable ennemisInstances en tant que variable globale en dehors des fonctions
let ennemisInstances = [];

function afficherEnnemis(ennemisData) {
  const ennemisList = document.getElementById("ennemis-list");
  ennemisList.innerHTML = ""; // Effacer le contenu précédent de la liste

  ennemisData.forEach((ennemiData, index) => {
    const ennemi = new Ennemi(
      ennemiData.nom,
      ennemiData.hp,
      ennemiData.defense,
      ennemiData.attaque,
      ennemiData.attaque_speciale,
      ennemiData.dommage_reduit,
      ennemiData.type
    );

    ennemisInstances.push(ennemi);
    const ennemiItem = document.createElement("li");
    ennemiItem.textContent = `Nom: ${ennemi.nom}, Type: ${ennemi.type}, Points de vie: ${ennemi.hp}`;
    ennemiItem.id = `ennemi-item-${index}`; // Ajouter un id unique pour chaque ennemi
    ennemisList.appendChild(ennemiItem);
  });
}

// Utilisation de la fonction getEnnemisDuNiveau
getEnnemisDuNiveau(niveauId)
  .then(ennemisData => {
    // Une fois les ennemis récupérés, on les affiche dans la page et on crée les instances d'Ennemi
    afficherEnnemis(ennemisData);
  });

// Utilisez ce code JavaScript pour gérer le bouton d'attaque
document.getElementById("btn-attaque").addEventListener("click", () => {
  // Supposez que l'indice de l'ennemi ciblé soit 0 (pour le premier ennemi)
  const indexEnnemiCible = 0;
  const ennemiCible = ennemisInstances[indexEnnemiCible];

  // Effectuez l'attaque en retirant 100 HP à l'ennemi ciblé
  ennemiCible.DamageEnnemi(100);

  // Mettez à jour l'affichage des points de vie de l'ennemi ciblé
  const ennemiItem = document.getElementById(`ennemi-item-${indexEnnemiCible}`);
  ennemiItem.textContent = `Nom: ${ennemiCible.nom}, Type: ${ennemiCible.type}, Points de vie: ${ennemiCible.hp}`;
});
