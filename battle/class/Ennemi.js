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
  
  // Exporter la classe pour pouvoir l'importer dans d'autres fichiers
  export default Ennemi;
  