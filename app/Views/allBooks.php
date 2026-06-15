<section id="section-allBooks" class="flex-col gap-3">

    <div id="section-header">
        <h1>Nos livres à l'échange</h1>

        <form>
            <button><img src="./images/search-logo.png"></button>
            <input type="text" id="search-input" placeholder="Rechercher un livre" name="search">
        </form>
    </div>

    <div class="books-container gap-3">
        <?php foreach ($books as $book) { ?>
            <a href="index.php?action=detailsBook&id=<?= $book->getId() ?>">
                <article class="card book-card">
                        <img src="<?= $book->getImage() ?>" alt="">
                        <div class="book-content">
                            <h2><?= $book->getTitle() ?></h2>
                            <p class="book-author"><?= $book->getAuthor() ?></p>
                        </div>
                        <p class="book-mention">Vendu par: <?= $book->getOwner() ?></p>
                </article>
            </a>
        <?php } ?>
    </div>

</section>