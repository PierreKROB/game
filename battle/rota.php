<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simulateur de Rotations Dokkan Battle</title>
</head>
<body>
  <h1>Simulateur de Rotations Dokkan Battle</h1>
  <div>
    <button id="rotationButton">Rotation suivante</button>
  </div>
  <div id="rotationDisplay"></div>
  <script>
    const characters = ['Goku', 'Vegeta', 'Piccolo', 'Gohan', 'Frieza', 'Cell', 'Majin Buu'];

    let rotationQueue = [...characters];

    function updateRotationDisplay() {
      const rotationDisplay = document.getElementById('rotationDisplay');
      rotationDisplay.innerHTML = rotationQueue.join(' ');
    }

    function performRotation() {
      const rotation = rotationQueue.splice(0, 3);
      rotationQueue.push(rotation[0], rotation[1], rotation[2]);
      updateRotationDisplay();
    }

    const rotationButton = document.getElementById('rotationButton');
    rotationButton.addEventListener('click', performRotation);

    // Initial update of the rotation display
    updateRotationDisplay();
  </script>
</body>
</html>
