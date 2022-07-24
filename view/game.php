<!DOCTYPE html>
<html>
<head>
	<title>Unblur That Game</title>
    <link rel="stylesheet" href="basics.css">
</head>
<body>
    <h1><span>Unblur</span> That Game</h1>
    <!-- todo text rules -->
	<div class="game-form-container">
		<img id="pixelatedImage" src="<?= $this->getGameImage()?>"
             crossorigin="anonymous" style="display: none"/>
        <div class="actions-container">
            <!-- todo check -->
            <input type="text" name="guess" id="guess" placeholder="Your guess"/>
            <button id="launchGame">Launch Game</button>
            <button id="pauseGame">Pause</button>
            <!-- todo share results-->
        </div>
	</div>

    <footer>
<!--        <a href="https://www.freepik.com/vectors/who-are-you">Vector from Freepik</a>
-->        <a href="https://www.boardgameatlas.com/">Data from Boardgameatlas</a>
    </footer>

    <script src="src/pixel-image.js"></script>
</body>
</html>