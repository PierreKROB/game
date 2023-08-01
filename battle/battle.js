// Classe HP_TOTAL
class HP_TOTAL {
    constructor(HP_MAX) {
      this.HP_MAX = HP_MAX;
      this.HP_NOW = HP_MAX;
    }
  
    // Méthode pour ajouter des points de vie
    Heal(montant) {
      this.HP_NOW += montant;
      // Vérifier si les points de vie actuels ne dépassent pas le maximum
      if (this.HP_NOW > this.HP_MAX) {
        this.HP_NOW = this.HP_MAX;
      }
    }
  
    // Méthode pour retirer des points de vie
    Damage(montant) {
      this.HP_NOW -= montant; // Correction ici, utiliser this.HP_NOW au lieu de pointsDeVieActuels
      // Vérifier si les points de vie actuels sont tombés en dessous de zéro
      if (this.HP_NOW < 0) {
        this.HP_NOW = 0;
      }
    }
  }
  