<section id="section-allBooks" class="flex-col gap-3">

    <div id="section-header">
        <h1>Nos livres à l'échange</h1>

        <form method="get" action="index.php">
            <label for="search-input" class="visually-hidden">Rechercher un livre</label>
            <input type="hidden" name="action" value="allBooks">
            <button type="submit"><img src="./images/search-logo.png" alt="search-logo"></button>
            <input type="text" 
            id="search-input" 
            placeholder="Rechercher un livre" 
            name="search"
            value="<?= htmlspecialchars($search ?? '') ?>">
        </form>
    </div>

    <div class="books-container gap-3">
        <?php foreach ($books as $book) { ?>
            <a href="index.php?action=detailsBook&id=<?= $book->getId() ?>">
                <article class="card book-card flex-col">
                        <img src="<?= htmlspecialchars($book->getCoverPicturePath()) ?>" alt="">
                        <div class="book-content">
                            <h2><?= htmlspecialchars($book->getTitle()) ?></h2>
                            <p class="book-author"><?= $book->getAuthor() ?></p>
                        </div>
                        <p class="book-mention">Vendu par: <?= htmlspecialchars($book->getUser()->getNickname()) ?></p>
                </article>
            </a>
        <?php } ?>
    </div>

</section>
