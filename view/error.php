<!DOCTYPE html>
<html>
<head>
	<title>Unblur That Game</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- disabled cache -->
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="pragma" content="no-cache;">

    <link rel="icon" type="image/png" href="images/favicon-32x32.png" />

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="basics.css">
</head>
<body class="bg-slate-800">
    <!-- NAV -->
    <?php include("nav.php");?>

    <div class="text-white px-10 md:px-15 pt-10 pb-5 min-h-50 box-border text-center">
        <h1 class="text-xl md:text-3xl text-center"><span>Unblur</span> That Game</h1>
        <p class="text-center">(Bêta)</p>
        <div class="text-md leading-loose sm:w-100 md:w-4/6 mx-auto mt-5">
            Impossible de se connecter à l'API Boardgameatlas. Veuillez retenter plus tard.
        </div>
    </div>

    <footer class="relative left-0 -bottom-10 mt-2 mw-100 text-center">
        <a href="https://www.boardgameatlas.com/">Données provenant de Boardgameatlas</a>
    </footer>
</body>
</html>