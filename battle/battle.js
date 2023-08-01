// Classe PointDeVie
class PointDeVie {
    constructor(pointsDeVieMax) {
      this.pointsDeVieMax = pointsDeVieMax;
      this.pointsDeVieActuels = pointsDeVieMax;
    }
  
    // Méthode pour ajouter des points de vie
    ajouterPointsDeVie(montant) {
      this.pointsDeVieActuels += montant;
      // Vérifier si les points de vie actuels ne dépassent pas le maximum
      if (this.pointsDeVieActuels > this.pointsDeVieMax) {
        this.pointsDeVieActuels = this.pointsDeVieMax;
      }
    }
  
    // Méthode pour retirer des points de vie
    retirerPointsDeVie(montant) {
      this.pointsDeVieActuels -= montant;
      // Vérifier si les points de vie actuels sont tombés en dessous de zéro
      if (this.pointsDeVieActuels < 0) {
        this.pointsDeVieActuels = 0;
      }
    }
  }
  