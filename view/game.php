<!DOCTYPE html>
<html>
<head>
	<title>Unblur That Game</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>

    <!-- JS autocomplete -->
    <script src="lib/jquery.easy-autocomplete.min.js"></script>
    <!-- CSS autocomplete -->
    <link rel="stylesheet" href="lib/easy-autocomplete.min.css">
    <!-- Additional CSS Themes file - autocomplete -->
    <link rel="stylesheet" href="lib/easy-autocomplete.themes.min.css">

    <!-- CSS Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link rel="stylesheet" href="basics.css">
</head>
<body class="bg-dark text-white pt-5 px-5 pb-0">
    <h1 class="fs-2"><span>Unblur</span> That Game</h1>
    <div class="rules fs-5 col-sm-12 col-md-8 mx-auto mt-5">
        <p>Dans ce jeu vous allez devoir retrouver le jeu le plus rapidement possible.</p>
        <p>Au début sa boite apparait toute pixélisée, elle se clarifie au fil du temps.</p>
        <p>Dès que vous pensez avoir trouvé, cliquez sur le bouton "Pause" pour que le temps s'arrete de défiler pendant que vous saisissez votre réponse.
            <br>Vous perdez quand le temps est écoulé ou si vous avez tenté plus de 5 propositions.</p>
        <br>
        <p>Si vous vous sentez prêt.e à relever le défi, cliquez sur un bouton "Lancer le jeu !".</p>

        <i>Attention : les solutions sont les titres en anglais</i>
    </div>
	<div class="game-form-container">
        <span class="counter"></span>
		<img id="pixelatedImage" src="<?= $this->getGameImage()?>"
             crossorigin="anonymous" style="display: none"/>
        <div class="actions-container">
            <div class="form-guess form-group mb-2">
                <input type="text" name="guess" id="guess" placeholder="Votre proposition"/>
                <input type="hidden" value="<?= base64_encode($this->getGameName())?>"/>
                <button id="validate" class="btn btn-primary mb-1">Valider</button>
            </div>
            <button id="launchGame" class="btn btn-light">Lancer le jeu !</button>
            <button id="pauseGame" class="btn btn-secondary" style="display: none">Pause</button>
            <!-- todo info sur le jeu ? -->
            <!-- todo share results-->
        </div>
	</div>

    <footer class="position-relative left-0 bottom-0 mt-2 mw-100">
        <a href="https://www.boardgameatlas.com/">Données provenant de Boardgameatlas</a>
    </footer>

    <script src="js/pixel-image.js"></script>
    <script src="js/autocomplete.js"></script>
</body>
</html>