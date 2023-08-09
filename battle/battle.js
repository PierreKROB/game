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
    this.hpMax = hp;
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

// Classe JavaScript pour les personnages
class Personnage {
  constructor(id_perso, nom, puissance, defense, HP, type, niveau, doublon) {
    this.id_perso = id_perso;
    this.nom = nom;
    this.puissance = puissance;
    this.defense = defense;
    this.HP = HP;
    this.type = type;
    this.niveau = niveau;
    this.doublon = doublon;
  }
}

class CombatListe {
  constructor(personnages) {
    this.liste = personnages;
    this.shuffleListe(); // Mélange initial de la liste
  }

  shuffleListe() {
    for (let i = this.liste.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [this.liste[i], this.liste[j]] = [this.liste[j], this.liste[i]];
    }
  }

  nextRotation() {
    const rotation = this.liste.splice(0, 3); // Retirez les trois premiers personnages
    this.liste = this.liste.concat(rotation); // Ajoutez-les à la fin de la liste
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



document.addEventListener("DOMContentLoaded", function () {
  // Convertir les chaînes JSON en objets
  var joueursObjets = joueursData.map(function (joueurJSON) {
    return JSON.parse(joueurJSON);
  });

  // Calculer la somme totale des points de vie
  var totalHP = 0;
  for (var i = 0; i < joueursObjets.length; i++) {
    var joueur = joueursObjets[i];
    var hp = joueur.hp; // Convertir en nombre
    if (!isNaN(hp)) {
      totalHP += hp;
    }
  }

  // Instancier la classe HP_TOTALplayer avec HP_MAX initial
  var hpTotalPlayer = new HP_TOTALplayer(totalHP); // Remplacez HP_MAX_INITIAL par la valeur correcte

  var hpDisplay = document.getElementById("hpDisplay"); // Remplacez par l'ID correct
  hpDisplay.innerHTML = hpTotalPlayer.HP_NOW;

  // Créer un tableau pour stocker les objets personnages
  var personnages = [];

  // Instancier des objets personnages à partir des données
  for (var i = 0; i < joueursObjets.length; i++) {
    var joueur = joueursObjets[i];
    var personnage = new Personnage(
      joueur.id,
      joueur.name,
      joueur.power,
      joueur.defense,
      joueur.hp,
      joueur.type,
      joueur.level,
      joueur.doublon
    );
    personnages.push(personnage);
  }

  const listeperso = new CombatListe(personnages)
  console.log(listeperso.liste)
  const listepersorota = listeperso.nextRotation()
  console.log(listepersorota.liste)
});