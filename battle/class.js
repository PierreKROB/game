// Classe HP_TOTAL
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
