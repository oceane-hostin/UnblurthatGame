document.addEventListener("DOMContentLoaded", function(event) {
    // initialize
    const pixelatedImage = document.querySelector("#pixelatedImage");
    const button = document.querySelector("#launchGame");
    const beginPixelForce = 50;
    const decreasePixel = 5;
    let gameLaunched = false;
    let pixelForce = beginPixelForce;
    const originalImage = pixelatedImage.cloneNode(true);

    // launch game on click
    button.addEventListener("click", async (e) => {
        if (!gameLaunched) {
            gameLaunched = true;
            button.style.display = "none";
            launchGame();
        }
    });


    function launchGame() {

        let gameProcess = setInterval(() => {
            if (pixelForce > 0) {
                pixelForce -= decreasePixel;
                pixelateImage(originalImage, parseInt(pixelForce));
            } else {
                clearIntervam = clearInterval(gameProcess);
            }
        }, 1000);
    }

    function pauseGame() {
        // too implement it
    }


    function pixelateImage(originalImage, pixelationFactor) {
        const canvas = document.createElement("canvas");
        canvas.crossOrigin = "Anonymous";
        const context = canvas.getContext("2d");
        const originalWidth = pixelatedImage.width;
        const originalHeight = pixelatedImage.height;
        const canvasWidth = originalWidth;
        const canvasHeight = originalHeight;
        canvas.width = canvasWidth;
        canvas.height = canvasHeight;
        context.drawImage(originalImage, 0, 0, originalWidth, originalHeight);
        const originalImageData = context.getImageData(
            0,
            0,
            originalWidth,
            originalHeight
        ).data;
        if (pixelationFactor !== 0) {
            for (let y = 0; y < originalHeight; y += pixelationFactor) {
                for (let x = 0; x < originalWidth; x += pixelationFactor) {
                    // extracting the position of the sample pixel
                    const pixelIndexPosition = (x + y * originalWidth) * 4;
                    // drawing a square replacing the current pixels
                    context.fillStyle = `rgba(
                      ${originalImageData[pixelIndexPosition]},
                      ${originalImageData[pixelIndexPosition + 1]},
                      ${originalImageData[pixelIndexPosition + 2]},
                      ${originalImageData[pixelIndexPosition + 3]}
                    )`;
                    context.fillRect(x, y, pixelationFactor, pixelationFactor);
                }
            }
        }
        pixelatedImage.src = canvas.toDataURL();
    }
})