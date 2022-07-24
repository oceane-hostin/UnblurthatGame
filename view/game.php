<!DOCTYPE html>
<html>
<head>
	<title>Unblur That Game</title>
    <link rel="stylesheet" href="basics.css">
</head>
<body>
    <h1><span>Unblur</span> That Game</h1>
    <div class="rules">
        <p>Dans ce jeu vous allez devoir retrouver le jeu le plus rapidement possible.</p>
        <p>Au début sa boit apparait toute pixélisée, elle se clarifie au fil du temps.</p>
        <p>Dès que vous pensez avoir trouvé, cliquez sur le bouton "Pause" pour que le temps arrete de défiler le temps que vous saisissez votre réponse.
            <br>Vous perdez quand le temps est écoulé ou si vous avez tenter plus de 5 propositions.</p>
        <br>
        <p>Si vous vous sentez prêt.e à relever le défi, cliquez sur un bouton "Lancer le jeu !".</p>

        <i>Attention : les solutions sont les titres en anglais</i>
    </div>
	<div class="game-form-container">
        <span class="counter"></span>
		<img id="pixelatedImage" src="<?= $this->getGameImage()?>"
             crossorigin="anonymous" style="display: none"/>
        <div class="actions-container">
            <div class="form-guess" style="display: none">
                <input type="text" name="guess" id="guess" placeholder="Votre proposition"/>
                <input type="hidden" value="<?= base64_encode($this->getGameName())?>"/>
                <button id="validate">Valider</button>
            </div>
            <button id="launchGame">Lancer le jeu !</button>
            <button id="pauseGame" style="display: none">Pause</button>
            <!-- todo info sur le jeu ? -->
            <!-- todo share results-->
        </div>
	</div>

    <footer>
        <a href="https://www.boardgameatlas.com/">Données provenant de Boardgameatlas</a>
    </footer>

    <script src="src/pixel-image.js"></script>
</body>
</html>