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
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"-->
<!--          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="basics.css">
</head>
<body class="bg-slate-800 text-white px-10 md:px-15 pt-10 pb-0">
    <h1 class="text-3xl text-center"><span>Unblur</span> That Game</h1>
    <p class="text-center">(Bêta)</p>
    <div class="rules text-xl sm:w-100 md:w-4/6 mx-auto mt-5">
        <p>Dans ce jeu vous allez devoir retrouver le jeu le plus rapidement possible.</p>
        <p>Au début sa boite apparait toute pixélisée, elle se clarifie au fil du temps.</p>
        <p>Dès que vous pensez avoir trouvé, cliquez sur le bouton "Pause" pour que le temps s'arrete de défiler pendant que vous saisissez votre réponse.
            <br>Vous perdez quand le temps est écoulé ou si vous avez tenté plus de 5 propositions.</p>
        <br>
        <p>Si vous vous sentez prêt.e à relever le défi, cliquez sur un bouton "Lancer le jeu !".</p>

        <i>Attention : les solutions sont les titres en anglais</i>
    </div>
	<div class="game-form-container text-center p-5">
        <span class="counter text-center mb-5"></span>
		<img id="pixelatedImage" src="<?= $this->getGameImage()?>"
             crossorigin="anonymous" class="my-3 mw-100 mx-auto max-w-[100%] md:max-w-[50%] max-h-[100%] md:max-h-[50%]" style="display: none"/>
        <div class="actions-container">
            <div class="form-guess form-group mb-2">
                <input type="text" name="guess" id="guess" placeholder="Votre proposition"/>
                <input type="hidden" value="<?= base64_encode($this->getGameName())?>"/>
                <button id="validate" class="relative -top-0.5 inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Valider</button>
            </div>
            <button id="launchGame" class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">Lancer le jeu !</button>
            <button id="pauseGame" class="relative -top-0.5 inline-block px-6 py-2.5 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-500 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-500 active:shadow-lg transition duration-150 ease-in-out" style="display: none">Pause</button>
            <!-- todo info sur le jeu ? -->
            <!-- todo share results-->
        </div>
	</div>

    <footer class="absolute left-0 bottom-0 mt-2 mw-100 text-center">
        <a href="https://www.boardgameatlas.com/">Données provenant de Boardgameatlas</a>
    </footer>

    <script src="js/pixel-image.js"></script>
    <script src="js/autocomplete.js"></script>
</body>
</html>