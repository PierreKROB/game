// Importer les classes à partir des fichiers séparés
import HP_TOTALplayer from './class/HP_TOTALplayer.js';
import Ennemi from './class/Ennemi.js';

async function getEnnemisDuNiveau(niveauId) {
  try {
    const url = `https://eligoal.com/game/api/niveaux/${niveauId}`;
    const response = await fetch(url);
    const data = await response.json();

    // Vérifier si la réponse de l'API contient bien une liste d'ennemis
    if (data && Array.isArray(data.liste_boss)) {
      // Créer des objets Ennemi à partir des données récupérées
      const ennemis = data.liste_boss.map((ennemiData) => {
        const { nom, hp, defense, attaque, attaque_speciale, dommage_reduit, type } = ennemiData;
        return new Ennemi(nom, hp, defense, attaque, attaque_speciale, dommage_reduit, type);
      });
      
      return ennemis;
    } else {
      console.error("Erreur lors de la récupération des ennemis du niveau.");
      return null;
    }
  } catch (error) {
    console.error("Erreur lors de la récupération des ennemis du niveau :", error);
    return null;
  }
}