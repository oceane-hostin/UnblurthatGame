document.addEventListener("DOMContentLoaded", function(event) {
    // initialize
    const pixelatedImage = document.querySelector("#pixelatedImage");
    const launchButton = document.querySelector("#launchGame");
    const pauseButton = document.querySelector("#pauseGame");
    const submitButton = document.querySelector("#validate");
    const shareButton = document.querySelector("#shareButton");
    const actions = document.querySelector(".game-form-container .actions-container");
    const guessForm = document.querySelector(".form-guess");
    const guessInput = guessForm.querySelector("input[type='text']");
    const solution = atob(guessForm.querySelector("input[name='current']").value);
    const guessId = guessForm.querySelector("input[name='currentId']").value;
    const rules = document.querySelector(".rules");
    const counter = document.querySelector(".counter");
    const beginPixelForce = 60;
    const decreasePixel = 3;
    const originalImage = pixelatedImage.cloneNode(true);
    const isInfiniteGame = document.body.classList.contains('infinite');

    const timeEmoji = "⏱";
    const winEmoji = "🥳";
    const lostEmoji = "😭";
    const greenSquare = "🟩";
    const redSquare = "🟥"
    const whiteSquare = "⬜";
    const blackSquare = "⬛"

    let totalTime = timeLeft = parseInt(beginPixelForce/decreasePixel);
    let gameLaunched = false;
    let gamePaused = false;
    let gameEnded = false;
    let gameWon = false;
    let pixelForce = beginPixelForce;
    let maxNumberTry = 5;
    let numberOfTry = 0;
    let tryAnswer = false;
    let gameResults = "";
    let gameSequence = "";
    // interval
    let gameProcess;

    let infoText = document. createElement("p");
    infoText.id = "info";
    document.querySelector(".game-form-container").appendChild(infoText);

    // launch game on click
    launchButton.addEventListener("click", async (e) => {
        if (!gameLaunched) {
            gameLaunched = true;
            updateCounter();
            launchGame();
            pixelateImage(originalImage, parseInt(beginPixelForce));
            launchButton.style.display = "none";
            rules.style.display = "none";
            pixelatedImage.style.display = "block";
            guessForm.style.display = "inline-block";
            pauseButton.style.display = "inline-block";
        }
    });

    // pause game
    pauseButton.addEventListener("click", async (e) => {
        gamePaused = !gamePaused;
        if (gamePaused) {
            tryAnswer = false;
            pauseButton.textContent = "Reprendre";
        } else {
            pauseButton.textContent = "Pause";
            if (!tryAnswer) {
                gameSequence += blackSquare;
                numberOfTry++;
            }
            if (numberOfTry >= maxNumberTry) {
                endOfGame();
            }
        }
    });

    // validate guess
    submitButton.addEventListener("click", async (e) => {
        if (gameLaunched) {
            tryAnswer = true;
            let proposal = guessInput.value;
            numberOfTry++;
            if (!gameEnded) {
                if (proposal == solution) {
                    gameEnded = true;
                    gameWon = true;
                    endOfGame();
                } else {
                    guessInput.value = "";
                    infoText.textContent = "Ce n'est pas ça !";
                    if (numberOfTry >= maxNumberTry) {
                        gameEnded = true;
                        endOfGame();
                    } else {
                        gameSequence += redSquare;
                    }
                }
            }
        }
    });

    shareButton.addEventListener("click", async (e) => {
        navigator.clipboard.writeText(gameResults).then(function() {
            shareButton.textContent = "Copié !";
        }, function() {

        });
    });

    function updateCounter(content = undefined) {
        if (content != undefined) {
            counter.innerHTML = content;
            counter.className = "text-md";
        } else {
            counter.innerHTML = timeLeft;
        }
    }

    function launchGame() {
        gameProcess = setInterval(() => {
            if (!gamePaused && !gameEnded) {
                if (pixelForce > 0) {
                    pixelForce -= decreasePixel;
                    timeLeft--;
                    updateCounter();
                    pixelateImage(originalImage, parseInt(pixelForce));
                } else {
                    gameEnded = true;
                    endOfGame();
                    clearInterval(gameProcess);
                }
            }
        }, 1000);
    }

    function endOfGame(phrase = undefined) {
        clearInterval(gameProcess);
        actions.parentElement.removeChild(actions);
        if (gameWon) {
            let timeUsed = parseInt(beginPixelForce / decreasePixel) - timeLeft;
            updateCounter("Félicitation, trouvé en "
                + timeUsed + " secondes"
                + " et en " + numberOfTry + "essai(s)"
            );
            gameSequence += greenSquare;
            shareResults();
        } else {
            infoText.textContent = "La solution attendue était : " + solution;
            shareResults();
            if (numberOfTry >= maxNumberTry) {
                updateCounter("Vous n'avez pas trouvé dans le nombre d'essais autorisé.");
            } else {
                updateCounter("Temps écoulé !");
            }
        }
    }

    function shareResults() {
        if (!isInfiniteGame) {
            shareButton.style.display = "inline-block";
            let timeSpend = totalTime - timeLeft;
            // todo id
            gameResults = "#UnblurThatGame " + guessId + "\n" + timeEmoji + " " + timeSpend + "\n";
            if (gameWon) {
                gameResults += winEmoji;
            } else {
                gameResults += lostEmoji;
            }

            // fill up game sequence
            let missingSquare = maxNumberTry - numberOfTry;
            while (missingSquare > 0) {
                gameSequence += whiteSquare;
                missingSquare--;
            }

            gameResults += gameSequence;
        }
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