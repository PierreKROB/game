const listeCouleur = ['end', 'tec', 'pui', 'agi', 'int', 'rainbow'];

class Orb {
    constructor(couleur) {
        this.couleur = couleur;
    }

    setCouleur(couleur) {
        if (listeCouleur.includes(couleur)) {
            this.couleur = couleur;
        }
    }

    toString() {
        return this.couleur.toString();
    }
}

class Plateau {
    constructor() {
        this.plateau = this.creerPlateau();
    }

    creerPlateau() {
        const plateau = [];
        for (let i = 0; i < 5; i++) {
            plateau.push([]);
            if (i % 2 === 0) {
                for (let j = 0; j < 5; j++) {
                    plateau[i].push(listeCouleur[Math.floor(Math.random() * 6)]);
                }
            } else {
                for (let j = 0; j < 4; j++) {
                    plateau[i].push(listeCouleur[Math.floor(Math.random() * 6)]);
                }
            }
        }
        return plateau;
    }

    toString() {
        return this.plateau.toString();
    }

    changeki(couleurInit, couleurNouv) {
        if (listeCouleur.includes(couleurNouv)) {
            for (let l = 0; l < this.plateau.length; l++) {
                for (let o = 0; o < this.plateau[l].length; o++) {
                    if (this.plateau[l][o] === couleurInit) {
                        this.plateau[l][o] = couleurNouv;
                    }
                }
                console.log(this.plateau[l]);
            }
        }
    }

    calculki(positionColonne, positionLigne) {
        // À compléter selon les besoins
    }
}

// Exemple d'utilisation :
const plateau = new Plateau();
console.log(plateau)
// plateau.changeki('end', 'pui'); // Exemple de changement de couleur
