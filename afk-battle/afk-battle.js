var canvas = document.querySelector('canvas');
var c = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

// Créer des tableaux d'images pour les deux types d'animations
var staticImages = [];
var kamehamehaImages = [];

// Remplir les tableaux d'images pour les deux types d'animations
for (var i = 0; i < 10; i++) {
    staticImages[i] = new Image();
    staticImages[i].src = './animations/Goku/static/goku-static' + (i + 1) + '.png';

    kamehamehaImages[i] = new Image();
    kamehamehaImages[i].src = './animations/Goku/super-attack/goku-kamehameha' + (i + 1) + '.png';
}

var frameIndex = 0; // Index de la frame actuelle
var isKamehameha = false; // Indicateur pour l'animation du Kamehameha

// Interval pour l'animation générale (toutes les 4 secondes)
setInterval(function () {
    isKamehameha = !isKamehameha; // Alterner entre les deux animations
    frameIndex = 0; // Réinitialiser l'index de frame

    // Effacer le canvas
    c.clearRect(0, 0, canvas.width, canvas.height);
}, 4000);

// Interval pour afficher les frames individuelles
setInterval(function () {
    c.clearRect(0, 0, canvas.width, canvas.height); // Effacer le canvas

    // Choisir le tableau d'images en fonction de l'animation actuelle
    var currentImages = isKamehameha ? kamehamehaImages : staticImages;

    // Dessiner l'image courante
    c.drawImage(currentImages[frameIndex], 100, 100, 100, 100);

    frameIndex++;
    if (frameIndex >= 10) {
        frameIndex = 0;
    }
}, 100);
