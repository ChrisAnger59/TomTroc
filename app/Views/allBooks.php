<section>
    <h2>Tous les livres</h2>
    <div class="books-container">
        <?php foreach ($books as $book) { ?>
            <a href="index.php?action=detailsBook&id=<?= $book->getId() ?>">
                <article class="card book-card">
                        <img src="<?= $book->getImage() ?>" alt="">
                        <div class="book-content">
                            <h3><?= $book->getTitle() ?></h3>
                            <p class="book-author"><?= $book->getAuthor() ?></p>
                        </div>
                        <p class="book-mention">Vendu par: <?= $book->getOwner() ?></p>
                </article>
            </a>
        <?php } ?>
    </div>
</section>