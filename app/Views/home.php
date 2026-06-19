<section id="section-introduction">
    <div class="intro-container">
        <div class="intro-text flex-col gap-1">
            <h1>Rejoignez nos lecteurs passionnés</h1>
            <p>Donnez une nouvelle vie à vos livres en les échangeant avec 
            d'autres amoureux de la lecture. 
            Nous croyons en la magie du partage de connaissances 
            et d'histoires à travers les livres.
            </p>
            <a href="index.php?action=allBooks"><button class="btn btn-primary">Découvrir</button></a>
        </div>

        <div class="intro-image">
            <img src="./images/img-home1.png" alt="">
            <p class="legend">Hamza</p>
        </div>
    </div>
</section>


<section id="section-last-add" class="flex-col gap-3">

    <h1>Les derniers livres ajoutés</h1>

        <div class="books-container">

        <?php foreach ($books as $book) { ?>
            <a href="index.php?action=detailsBook&id=<?= $book->getId() ?>">
                <article class="card book-card">
                        <img src="<?= htmlspecialchars($book->getCoverPicturePath()) ?>" alt="">
                        <div class="book-content">
                            <h2><?= htmlspecialchars($book->getTitle()) ?></h2>
                            <p class="book-author"><?= htmlspecialchars($book->getAuthor()) ?></p>
                        </div>
                        <p class="book-mention">Vendu par: <?= htmlspecialchars($book->getOwner()) ?></p>
                </article>
            </a>
        <?php } ?>

        </div>

        <a href="index.php?action=allBooks"><button class="btn btn-primary">Voir tous les livres</button></a>
</section>


<section id="section-pitch" class="flex-col gap-3">
    <h1>Comment ça marche ?</h1>
    <p class="pitch-desc">Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</p>

    <div class="pitch-cards">
        <article class="card pitch-card">
            <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
        </article>

        <article class="card pitch-card">
            <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
        </article>

        <article class="card pitch-card">
            <p>Parcourez les livres disponibles chez d'autres membres.</p>
        </article>

        <article class="card pitch-card">
            <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
        </article>
    </div>

    <a href="index.php?action=allBooks"><button class="btn btn-outline">Voir tous les livres</button></a>

</section>

<section id="banner">
    <img src="./images/banner.jpg" alt="Banderole bibliothèque">
</section>

<section id="section-values">
    <div class="values-container flex-col gap-2">
        <h1>Nos valeurs</h1>
        <article class="values-text flex-col gap-1">
            <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
            <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. </p>
            <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
        </article>
        <img src="./images/logo-vector.svg" alt="logo vecteur" class="corner-img">
        <p class="signature">L'équipe Tom Troc</p> 
    </div>

</section>