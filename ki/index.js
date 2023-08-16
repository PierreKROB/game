// Définition des couleurs d'orbes
const orbColors = ['end', 'tec', 'pui', 'agi', 'int', 'rainbow'];

// Classe pour représenter une orbe
class Orb {
    constructor(color) {
        this.color = color;
    }
}

// Classe pour représenter le plateau de Ki
class KiPlateau {
    constructor(rows) {
        this.rows = rows;
        this.grid = this.generateGrid();
    }

    // Méthode pour générer le tableau de Ki
    generateGrid() {
        const grid = [];
        for (let i = 0; i < this.rows.length; i++) {
            const row = [];
            const numOrbs = (i % 2 === 0) ? 5 : 4;
            for (let j = 0; j < numOrbs; j++) {
                const randomColor = orbColors[Math.floor(Math.random() * orbColors.length)];
                const orb = new Orb(randomColor);
                row.push(orb);
            }
            grid.push(row);
        }
        return grid;
    }
}

// Création d'un plateau de Ki avec 5 lignes
const kiPlateau = new KiPlateau([5, 4, 5, 4, 5]);

// Récupération de l'élément plateau-de-ki
const plateauElement = document.querySelector('.plateau-de-ki');

// Affichage du tableau de Ki généré
console.log(kiPlateau.grid);

// Parcours du tableau de Ki généré et création des sphères ligne par ligne
kiPlateau.grid.forEach((row, rowIndex) => {
    const ligneElement = document.createElement('div');
    ligneElement.classList.add('ligne-ki');

    row.forEach((orb, columnIndex) => {
        const sphereElement = document.createElement('div');
        sphereElement.classList.add('sphere-ki', `couleur-${orb.color}`);
        ligneElement.appendChild(sphereElement);

        if (rowIndex === kiPlateau.grid.length - 1) {
            // Gestionnaire d'événement lorsque le joueur survole une sphère
            sphereElement.addEventListener('mouseenter', () => {
                // Changer la couleur des orbes voisines sur le côté
                if (columnIndex > 0) {
                    const orbLeft = row[columnIndex - 1];
                    const leftSphere = plateauElement.children[rowIndex].children[columnIndex - 1];
                    leftSphere.classList.add(`couleur-${orbLeft.color}-relier`);
                }
                if (columnIndex < row.length - 1) {
                    const orbRight = row[columnIndex + 1];
                    const rightSphere = plateauElement.children[rowIndex].children[columnIndex + 1];
                    rightSphere.classList.add(`couleur-${orbRight.color}-relier`);
                }

                // Changer la couleur des orbes voisines en haut
                if (rowIndex > 0) {
                    const orbAbove = kiPlateau.grid[rowIndex - 1][columnIndex];
                    const aboveSphere = plateauElement.children[rowIndex - 1].children[columnIndex];
                    aboveSphere.classList.add(`couleur-${orbAbove.color}-relier`);
                }
            });

            // Gestionnaire d'événement lorsque le joueur quitte une sphère
            sphereElement.addEventListener('mouseleave', () => {
                // Remettre la couleur d'origine des orbes voisines sur le côté
                if (columnIndex > 0) {
                    const leftSphere = plateauElement.children[rowIndex].children[columnIndex - 1];
                    leftSphere.classList.remove(`couleur-${row[columnIndex - 1].color}-relier`);
                }
                if (columnIndex < row.length - 1) {
                    const rightSphere = plateauElement.children[rowIndex].children[columnIndex + 1];
                    rightSphere.classList.remove(`couleur-${row[columnIndex + 1].color}-relier`);
                }

                // Remettre la couleur d'origine des orbes voisines en haut
                if (rowIndex > 0) {
                    const aboveSphere = plateauElement.children[rowIndex - 1].children[columnIndex];
                    aboveSphere.classList.remove(`couleur-${kiPlateau.grid[rowIndex - 1][columnIndex].color}-relier`);
                }
            });
        }
    });

    plateauElement.appendChild(ligneElement);
});