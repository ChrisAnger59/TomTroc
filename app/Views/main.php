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
                <a href="index.php?action=home">
                    <img src="./images/logo.png" alt="Logo-site" class="logo-site">
                </a>
                <a href="index.php?action=home">Accueil</a>
                <a href="index.php?action=allBooks">Nos livres à l'échange</a>
            </div>

            <div class="nav-group">
                <a href="index.php?action=mailBox"><img src="./images/Icon_messagerie.png" alt="mailBox" id="mailBoxLogo">Messagerie<?php if(isset($currentIdUser)): ?><span><?= $unreadCount ?></span><?php endif; ?></a>
                <a href="index.php?action=profil"><img src="./images/Icon_mon_compte.png" alt="profil" id="profilLogo">Mon compte</a>
                
                <?php if(isset($currentIdUser)): ?>
                    <a href="index.php?action=disconnect">Deconnexion</a>
                <?php else: ?>
                <a href="index.php?action=loginForm">Connexion</a>
                <?php endif; ?>
            </div>
        </nav>

    </header>

    <main>    
        <?php if(!empty($error)): ?>
            <p id="errorMessage"><?= $error ?></p>
        <?php endif; ?>
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>
    
    <footer>
        <nav id="nav-footer">
            <a href="index.php?action=privacyPolicy">Politique de confidentialité</a>
            <a href="index.php?action=legalMentions">Mentions légales</a>
            <a href="index.php?action=home">Tom Troc©</a>
            <a href="index.php?action=home" id="logo-footer"><img src="./images/logo-alt-TomTroc.png" alt="Logo alternatif TomTroc"></a>
        </nav>
    </footer>

</body>
</html>