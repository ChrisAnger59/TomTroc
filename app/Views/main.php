<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomTroc</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav id="nav-header">
            <div class="nav-group">
                <a href="index.php">
                    <img src="./images/logo.png" alt="Logo" class="logo-site">
                </a>
                <a href="index.php">Accueil</a>
                <a href="#">Nos livres</a>
            </div>

            <div class="nav-group">
                <a href="#"><img src="./images/Icon messagerie.png" width="15px">Messagerie</a>
                <a href="#"><img src="./images/Icon mon compte.png" width="10px">Mon compte</a>
                <a href="#">Connexion</a>
            </div>
        </nav>

    </header>

    <main>    
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>
    
    <footer>
        <nav id="nav-footer">
            <a href="#">Politique de confidentialité</a>
            <a href="#">Mentions légales</a>
            <a href="#">Tom Troc©</a>
            <a href="#" id="logo-footer"><img src="./images/logo-alt-TomTroc.png" alt="Logo alternatif TomTroc"></a>
        </nav>
    </footer>

</body>
</html>