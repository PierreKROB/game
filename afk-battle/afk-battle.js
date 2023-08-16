var canvas = document.querySelector('canvas');
var c = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

// Create empty array
var images = [];
images.length = 10;

// Push the images into array
for (var i = 0; i < images.length; i++) {
    images[i] = new Image();
    images[i].src = './animations/Goku/static/goku-kamehameha' + (i + 1) + '.png';
}

var i = 0; // Start from the first image
setInterval(function () {
    c.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
    c.drawImage(images[i], 100, 100, 100, 100);
    i++;
    if (i >= images.length) {
        i = 0;
    }
}, 100);
