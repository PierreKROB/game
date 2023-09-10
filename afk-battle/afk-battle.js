var canvas = document.querySelector('canvas');
var c = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

var staticImages = [];
staticImages.length = 10;

for (var i = 1; i <= staticImages.length - 1; i++) {
    staticImages[i] = new Image();
    staticImages[i].src = './animations/Goku/static/goku-static' + i.toString() + '.png';
}

var kamehamehaImages = [];
kamehamehaImages.length = 11;

for (var i = 1; i <= kamehamehaImages.length - 1; i++) {
    kamehamehaImages[i] = new Image();
    kamehamehaImages[i].src = './animations/Goku/super-attack/goku-kamehameha' + i.toString() + '.png';
}

var staticIndex = 1;
var kamehamehaIndex = 1;
var animationInterval;

function startStaticAnimation() {
    animationInterval = setInterval(function () {
        c.clearRect(0, 0, canvas.width, canvas.height);
        c.drawImage(staticImages[staticIndex], 100, 100, 100, 100);
        staticIndex++;
        if (staticIndex >= staticImages.length) {
            staticIndex = 1;
        }
    }, 100);
}

function startKamehamehaAnimation() {
    clearInterval(animationInterval);

    var kamehamehaFrame = 1;
    var kamehamehaInterval = setInterval(function () {
        c.clearRect(0, 0, canvas.width, canvas.height);
        c.drawImage(kamehamehaImages[kamehamehaFrame], 100, 100, 100, 100);
        kamehamehaFrame++;
        if (kamehamehaFrame >= kamehamehaImages.length) {
            clearInterval(kamehamehaInterval);
            startStaticAnimation();
        }
    }, 100);
}

startStaticAnimation();
setInterval(function () {
    startKamehamehaAnimation();
}, 4000);
